<?php

namespace App\Services\Backend;

use App\Config\MediaConfig;
use App\Exceptions\MediaException;
use App\Models\MediaModel;
use App\Models\MediaRelationsModel;
use App\Models\MediaDownloadTokenModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class MediaService
{
    protected MediaModel $mediaModel;
    protected MediaRelationsModel $mediaRelationsModel;
    protected MediaDownloadTokenModel $mediaDownloadTokenModel;
    protected \CodeIgniter\Log\Logger $logger;

    public function __construct()
    {
        $this->mediaModel = new MediaModel();
        $this->mediaRelationsModel = new MediaRelationsModel();
        $this->mediaDownloadTokenModel = new MediaDownloadTokenModel();
        $this->logger = service('logger');
        helper('editor_helper');
    }
    /**
     * 验证上传路径安全（防止目录遍历）
     * 确保路径不会跳出上传目录
     */
    protected function validateUploadPath(string $path): void
    {
        $realPath = realpath(dirname(FCPATH . $path));
        $allowedDir = realpath(MediaConfig::UPLOAD_ABSOLUTE_PATH);

        if ($realPath === false || !str_starts_with($realPath, (string) $allowedDir)) {
            throw MediaException::invalidPath($path);
        }
    }

    /**
     * 清除媒体关联缓存
     */
    protected function clearMediaCache(int $owner_id, string $owner_type): void
    {
        $cacheKey = "media_{$owner_type}_{$owner_id}";
        cache()->delete($cacheKey);
    }

    /**
     * 同步媒体中间表（create / update 通用）
     * 无需用户验证（后台专用）
     */
    public function syncMedia(int $owner_id, string $owner_type, array $data): void
    {
        try {
            // 旧关联
            $oldRelations = $this->mediaRelationsModel
                ->where('owner_type', $owner_type)
                ->where('owner_id', $owner_id)
                ->findAll();

            $oldMediaIds = array_column($oldRelations, 'media_id');

            // 新提交的媒体
            $contentImages = extract_editor_image_ids($data['content_delta'] ?? '');
            $thumbnails = normalize_ids($data['thumbnail_image_ids'] ?? []);
            $galleries = normalize_ids($data['gallery_image_ids'] ?? []);
            $files = normalize_ids($data['file_ids'] ?? []);

            $newMediaIds = merge_media_ids(
                $thumbnails,
                $galleries,
                $contentImages,
                $files
            );

            /** ---------- 重建中间表 ---------- */
            $this->mediaRelationsModel
                ->where('owner_type', $owner_type)
                ->where('owner_id', $owner_id)
                ->delete();

            $relations = [];
            $usageMap = [
                'thumbnail' => $thumbnails,
                'gallery' => $galleries,
                'content' => $contentImages,
                'file' => $files,
            ];

            foreach ($usageMap as $type => $ids) {
                foreach ($ids as $sort => $mediaId) {
                    $relations[] = [
                        'media_id' => $mediaId,
                        'owner_type' => $owner_type,
                        'owner_id' => $owner_id,
                        'usage_type' => $type,
                        'sort' => $sort,
                    ];
                }
            }

            if ($relations) {
                if (!$this->mediaRelationsModel->insertBatch($relations)) {
                    throw new \RuntimeException(json_encode($this->mediaRelationsModel->errors()));
                }
            }

            /** ---------- media.is_used 状态同步 ---------- */
            $added = array_diff($newMediaIds, $oldMediaIds);
            $removed = array_diff($oldMediaIds, $newMediaIds);

            if ($added) {
                $this->mediaModel->whereIn('id', $added)->set(['is_used' => 1])->update();
            }

            if ($removed) {
                $this->mediaModel->whereIn('id', $removed)->set(['is_used' => 0])->update();
            }

            // 清除缓存
            $this->clearMediaCache($owner_id, $owner_type);

            $this->logger->info("Media synced: owner={$owner_type}#{$owner_id}, added=" . count($added) . ", removed=" . count($removed));
        } catch (\Throwable $e) {
            $this->logger->error("Media sync failed for {$owner_type}#{$owner_id}: {$e->getMessage()}");
            throw $e;
        }
    }
    /**
     * 通用上传入口
     * 支持图片、文档、视频等多种文件类型
     */
    public function upload(
        UploadedFile $file,
        int $userId,
        ?string $uploadToken = null
    ): array {
        try {
            if (!$file->isValid()) {
                throw MediaException::uploadFailed($file->getErrorString());
            }

            $mime = $file->getMimeType();

            // 验证文件类型
            if (!MediaConfig::isAllowedMime($mime)) {
                $this->logger->warning("Upload rejected: invalid MIME type {$mime}");
                throw MediaException::invalidMime($mime);
            }
           

            // 验证文件大小
            $fileSizeMb = (int) ($file->getSize() / (1024 * 1024));
            if ($fileSizeMb > MediaConfig::MAX_SIZE_MB) {
                $this->logger->warning("Upload rejected: file {$fileSizeMb}MB exceeds {MediaConfig::MAX_SIZE_MB}MB limit");
                throw MediaException::fileTooLarge($fileSizeMb, MediaConfig::MAX_SIZE_MB);
            }

            // 生成 upload token（会话标识）
            $uploadToken ??= bin2hex(random_bytes(16));

            // 分类目录
            $typeGroup = MediaConfig::getTypeGroupByMime($mime);

            // 构建存储路径
            $subDir = date('Y/m/d') . '/';
            $relativeBase = MediaConfig::UPLOAD_BASE_DIR . "/{$typeGroup}/{$subDir}";
            $absolutePath = FCPATH . $relativeBase;

            // 创建目录（递归）
            if (!is_dir($absolutePath)) {
                @mkdir($absolutePath, MediaConfig::DIR_PERMISSION, true);
            }

            // 设置目录权限
            @chmod($absolutePath, MediaConfig::DIR_PERMISSION);

            // 移动上传文件
            $newName = $file->getRandomName();
            $fileFullPath = $absolutePath . $newName;

            if (!$file->move($absolutePath, $newName)) {
                throw MediaException::uploadFailed('unable to move file to destination');
            }

            // 设置文件权限（不可执行）
            @chmod($fileFullPath, MediaConfig::FILE_PERMISSION);

            $relativePath = $relativeBase . $newName;

            // 获取图片宽高（仅图片类型）
            [$width, $height] = $this->resolveImageSize($typeGroup, $fileFullPath);

            // 入库
            $mediaId = $this->mediaModel->insert([
                'path' => $relativePath,
                'original_name' => $file->getClientName(),
                'mime' => $mime,
                'extension' => $file->getExtension(),
                'size' => $file->getSize(),
                'width' => $width,
                'height' => $height,
                'type_group' => $typeGroup,
                'upload_token' => $uploadToken,
                'is_used' => 0,
                'created_by' => $userId,
                'public' => 1, // 默认公开媒体文件
            ]);

            $this->logger->info("File uploaded successfully: media_id={$mediaId}, user_id={$userId}, mime={$mime}");

            return [
                'media_id' => $mediaId,
                'path' => $relativePath,
                'url' => base_url($relativePath),
                'name' => $newName,
                'original_name' => $file->getClientName(),
                'type' => $typeGroup,
                'upload_token' => $uploadToken,
            ];
        } catch (MediaException $e) {
            $this->logger->error("Media upload error: {$e->getMessage()}", ['code' => $e->getCode()]);
            throw $e;
        } catch (\Throwable $e) {
            $this->logger->error("Unexpected upload error: {$e->getMessage()}");
            throw MediaException::uploadFailed($e->getMessage());
        }
    }
    /**
     * 通过 owner 删除媒体
     * 优化：批量查询替代 N+1 查询，添加路径安全检查与日志
     */
    public function deleteByOwner(int $owner_id): void
    {
        try {
            // 查找该 owner 的所有关联
            $relations = $this->mediaRelationsModel
                ->where('owner_id', $owner_id)
                ->findAll();

            if (empty($relations)) {
                return;
            }

            $mediaIds = array_unique(array_column($relations, 'media_id'));

            // 删除关联表
            $this->mediaRelationsModel->where('owner_id', $owner_id)->delete();

            // 优化：批量查询哪些 media 仍被其他内容使用（替代 N+1）
            $stillUsedIds = $this->mediaRelationsModel
                ->distinct()
                ->select('media_id')
                ->whereIn('media_id', $mediaIds)
                ->findAll();
            $stillUsedIds = array_column($stillUsedIds, 'media_id');

            // 计算需要删除的媒体
            $unusedIds = array_diff($mediaIds, $stillUsedIds);

            if (empty($unusedIds)) {
                $this->logger->info("Owner {$owner_id}: no unused media to delete");
                return;
            }

            // 批量获取媒体记录
            $medias = $this->mediaModel->whereIn('id', $unusedIds)->findAll();

            foreach ($medias as $media) {
                try {
                    // 路径安全检查（防止目录遍历）
                    $this->validateUploadPath($media['path']);

                    // 删除物理文件
                    $filePath = FCPATH . ltrim($media['path'], '/');
                    if (is_file($filePath)) {
                        @unlink($filePath);
                        $this->logger->debug("Deleted file: {$filePath}");
                    }
                } catch (MediaException $e) {
                    $this->logger->error("Invalid media path detected: {$media['path']}, skipping file deletion");
                    // 继续处理其他文件
                    continue;
                }
            }

            // 批量删除数据库记录
            $this->mediaModel->whereIn('id', $unusedIds)->delete();
            // 删除相关下载 token
            $this->mediaDownloadTokenModel->whereIn('media_id', $unusedIds)->delete();
            
            $this->logger->info("Owner {$owner_id} media deleted: " . count($unusedIds) . " records");
        } catch (\Throwable $e) {
            $this->logger->error("Delete by owner failed for {$owner_id}: {$e->getMessage()}");
            throw $e;
        }
    }
    /**
     * 根据 MIME 类型获取文件分组
     */
    protected function resolveTypeGroup(string $mime): string
    {
        return MediaConfig::getTypeGroupByMime($mime);
    }

    /**
     * 获取图片宽高（仅用于图片类型）
     *
     * @return array [width, height] 或 [null, null]
     */
    protected function resolveImageSize(string $type, string $path): array
    {
        if ($type !== 'images') {
            return [null, null];
        }

        try {
            $size = getimagesize($path);
            if ($size === false) {
                return [null, null];
            }

            [$width, $height] = $size;

            // 验证图片尺寸（防止过大）
            if ($width > MediaConfig::MAX_IMAGE_DIMENSION || $height > MediaConfig::MAX_IMAGE_DIMENSION) {
                $this->logger->warning("Image dimensions exceed limits: {$width}x{$height}");
                return [null, null];
            }

            return [$width, $height];
        } catch (\Throwable $e) {
            $this->logger->debug("Failed to get image size: {$e->getMessage()}");
            return [null, null];
        }
    }

    /**
     * 获取媒体关联信息（支持缓存）
     */
    public function getMedia(int $owner_id, string $owner_type): array
    {
        $cacheKey = "media_{$owner_type}_{$owner_id}";

        // 尝试从缓存读取
        $cached = cache($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $relations = $this->mediaRelationsModel
            ->where('owner_type', $owner_type)
            ->where('owner_id', $owner_id)
            ->orderBy('sort', 'asc')
            ->findAll();

        $usageMap = [
            'thumbnail' => [],
            'gallery' => [],
            'file' => [],
        ];

        foreach ($relations as $rel) {
            if (isset($usageMap[$rel['usage_type']])) {
                $usageMap[$rel['usage_type']][] = $rel['media_id'];
            }
        }

        $result = [
            'thumbnail_image_ids' => $usageMap['thumbnail'],
            'gallery_image_ids' => $usageMap['gallery'],
            'file_ids' => $usageMap['file'],
            'thumbnails' => empty($usageMap['thumbnail'])
                ? []
                : $this->mediaModel->findByIdsInOrder($usageMap['thumbnail']),
            'galleries' => empty($usageMap['gallery'])
                ? []
                : $this->mediaModel->findByIdsInOrder($usageMap['gallery']),
            'files' => empty($usageMap['file'])
                ? []
                : $this->mediaModel->findByIdsInOrder($usageMap['file']),
        ];

        // 缓存结果
        cache()->save($cacheKey, $result, MediaConfig::CACHE_DURATION);

        return $result;
    }
    /**
     * 转存为 OG Image
     * 根据语言生成社交媒体分享用的图片
     */
    public function saveOgImage(int $imageId, string $lang): array
    {
        try {
            // 获取图片记录
            $image = $this->mediaModel->find($imageId);
            if (!$image) {
                throw MediaException::recordNotFound('Image', $imageId);
            }

            $imagePath = FCPATH . ltrim($image['path'], '/');
            if (!is_file($imagePath)) {
                throw MediaException::fileNotFound($imagePath);
            }

            // 验证路径安全
            $this->validateUploadPath($image['path']);

            // 生成 OG image 文件名
            $ogName = $lang . '_default_og_image.' . $image['extension'];
            $ogPath = FCPATH . $ogName;

            if (!copy($imagePath, $ogPath)) {
                throw new \RuntimeException('Failed to copy OG image');
            }

            @chmod($ogPath, MediaConfig::FILE_PERMISSION);

            $this->logger->info("OG image saved: {$ogName} from image_id={$imageId}");

            return [
                'status' => 'success',
                'path' => '/' . $ogName,
            ];
        } catch (MediaException $e) {
            $this->logger->error("OG image save error: {$e->getMessage()}");
            throw $e;
        } catch (\Throwable $e) {
            $this->logger->error("Unexpected error saving OG image: {$e->getMessage()}");
            throw new \RuntimeException('Failed to save OG image: ' . $e->getMessage());
        }
    }

    /**
     * 生成 favicon.ico（PNG 内嵌）
     * 将 PNG 文件转换为 ICO 格式
     */
    public function pngToIcoPure(int $imageId): array
    {
        try {
            // 获取图片记录
            $image = $this->mediaModel->find($imageId);
            if (!$image) {
                throw MediaException::recordNotFound('Image', $imageId);
            }

            $pngPath = FCPATH . ltrim($image['path'], '/');
            if (!is_file($pngPath)) {
                throw MediaException::fileNotFound($pngPath);
            }

            // 验证路径安全
            $this->validateUploadPath($image['path']);

            // 限制文件大小（避免内存溢出）
            if (filesize($pngPath) > 2 * 1024 * 1024) { // 2MB 限制
                throw new \RuntimeException('PNG file too large for favicon conversion');
            }

            // 读取 PNG 二进制
            $png = file_get_contents($pngPath);
            if ($png === false) {
                throw MediaException::fileNotFound($pngPath);
            }

            // PNG 文件头校验
            if (substr($png, 0, 8) !== "\x89PNG\x0D\x0A\x1A\x0A") {
                throw MediaException::pngInvalid('Invalid PNG file header');
            }

            // 解析 IHDR 获取宽高
            $ihdrPos = strpos($png, 'IHDR');
            if ($ihdrPos === false) {
                throw MediaException::pngInvalid('Missing IHDR chunk');
            }

            $width = unpack('N', substr($png, $ihdrPos + 4, 4))[1];
            $height = unpack('N', substr($png, $ihdrPos + 8, 4))[1];

            // 验证尺寸
            if ($width > MediaConfig::MAX_FAVICON_SIZE || $height > MediaConfig::MAX_FAVICON_SIZE) {
                throw MediaException::pngInvalid("Size {$width}x{$height} exceeds favicon limit (" . MediaConfig::MAX_FAVICON_SIZE . "x" . MediaConfig::MAX_FAVICON_SIZE . ")");
            }

            // 构建 ICO 文件
            // ICONDIR (6 bytes)
            $ico = pack('vvv', 0, 1, 1);

            // ICONDIRENTRY (16 bytes)
            $ico .= pack(
                'CCCCvvVV',
                $width === 256 ? 0 : $width,
                $height === 256 ? 0 : $height,
                0,          // color count
                0,          // reserved
                1,          // planes
                32,         // bit count
                strlen($png),
                6 + 16      // data offset
            );

            // PNG 数据
            $ico .= $png;

            $faviconPath = FCPATH . 'favicon.ico';
            if (file_put_contents($faviconPath, $ico, LOCK_EX) === false) {
                throw new \RuntimeException('Failed to write favicon.ico');
            }

            // 设置文件权限
            @chmod($faviconPath, MediaConfig::FILE_PERMISSION);

            // 清理 opcache
            if (function_exists('opcache_invalidate')) {
                @opcache_invalidate($faviconPath, true);
            }

            $this->logger->info("Favicon generated: {$width}x{$height} from image_id={$imageId}");

            return [
                'status' => 'success',
                'path' => '/favicon.ico',
                'width' => $width,
                'height' => $height,
                'image_id' => $imageId,
            ];
        } catch (MediaException $e) {
            $this->logger->error("Favicon generation error: {$e->getMessage()}");
            throw $e;
        } catch (\Throwable $e) {
            $this->logger->error("Unexpected error generating favicon: {$e->getMessage()}");
            throw new \RuntimeException('Favicon generation failed: ' . $e->getMessage());
        }
    }
}
