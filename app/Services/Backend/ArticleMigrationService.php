<?php

namespace App\Services\Backend;

use App\Models\MediaModel;
use App\Models\MediaRelationsModel;
use App\Models\OldArticleModel;
use App\Models\ArticlesModel;
use App\Models\ArticlesLangModel;
use App\Models\CategoryModel;
use App\Models\OldCategoryModel;
use CodeIgniter\Files\File;
use Config\Database;

/**
 * 文章迁移服务
 * 负责将旧系统的文章数据迁移到新系统
 */
class ArticleMigrationService
{
    protected OldArticleModel $OldArticleModel;
    protected ArticlesModel $ArticlesModel;
    protected ArticlesLangModel $ArticlesLangModel;
    protected MediaModel $MediaModel;
    protected MediaRelationsModel $MediaRelationsModel;
    protected CategoryModel $CategoryModel;
    protected OldCategoryModel $OldCategoryModel;

    protected $uploadPath = FCPATH . 'uploads/articles/';
    protected $migratedMediaLog = []; // 记录已迁移的媒体，避免重复处理
    protected $categoryMapping = []; // 缓存分类映射 [old_category_index => new_category_id]
    protected $systemUserId = null;

    public function __construct()
    {
        $this->OldArticleModel = new OldArticleModel();
        $this->ArticlesModel = new ArticlesModel();
        $this->ArticlesLangModel = new ArticlesLangModel();
        $this->MediaModel = new MediaModel();
        $this->MediaRelationsModel = new MediaRelationsModel();
        $this->CategoryModel = new CategoryModel();
        $this->OldCategoryModel = new OldCategoryModel();

        $this->systemUserId = $this->getSystemUserId();
        $this->categoryMapping = $this->buildCategoryMapping();
    }

    /**
     * ========== 第一步：迁移媒体文件 ==========
     * @return array ['old_path' => 'new_media_id', ...]
     * 
     * 说明：
     * - article_big_image 作为缩略图（thumbnail）使用
     * - 忽略 article_image 字段
     * - 数据库路径 ./uploads/file/ → 实际文件在 ./uploads/tmp/file/
     */
    public function migrateMediaFiles(): array
    {
        log_message('info', "========== 开始迁移媒体文件 ==========");
        $db = Database::connect();
        
        try {
            // 获取所有有图片的文章（包括 article_big_image 和 article_image）
            $oldArticles = $db->table('taxonomy_article')
                ->select('article_index, article_big_image, article_image')
                ->where('article_big_image !=', '')
                ->orWhere('article_image !=', '')
                ->get()
                ->getResultArray();
            
            log_message('info', "从数据库查询得到 " . count($oldArticles) . " 篇有图片的文章");
        } catch (\Throwable $e) {
            log_message('error', "查询失败: " . $e->getMessage());
            return [];
        }
        
        $mediaMapping = [];
        
        if (empty($oldArticles)) {
            log_message('warning', "旧文章表为空或没有图片，无法迁移媒体文件");
            return $mediaMapping;
        }

        log_message('info', "开始处理 " . count($oldArticles) . " 个媒体文件");

        foreach ($oldArticles as $article) {
            // 优先处理 article_big_image
            if (!empty($article['article_big_image'])) {
                $dbPath = $article['article_big_image'];
                log_message('debug', "处理文章 INDEX {$article['article_index']}: {$dbPath} (article_big_image)");
                
                $result = $this->processMediaFile($dbPath, 'thumbnail');
                
                if ($result && isset($result['media_id'])) {
                    $thumbMediaId = $result['media_id'];
                    $mediaMapping[$dbPath] = $thumbMediaId;
                    log_message('info', "文章 {$article['article_index']} 的 article_big_image 已迁移，媒体ID: {$thumbMediaId}");
                } else {
                    log_message('warning', "文章 {$article['article_index']} 的 article_big_image 迁移失败: {$dbPath}");
                }
            }
            
            // 如果 article_big_image 为空，则处理 article_image
            if (empty($article['article_big_image']) && !empty($article['article_image'])) {
                $dbPath = $article['article_image'];
                log_message('debug', "处理文章 INDEX {$article['article_index']}: {$dbPath} (article_image 替代)");
                
                $result = $this->processMediaFile($dbPath, 'thumbnail');
                
                if ($result && isset($result['media_id'])) {
                    $thumbMediaId = $result['media_id'];
                    $mediaMapping[$dbPath] = $thumbMediaId;
                    log_message('info', "文章 {$article['article_index']} 的 article_image 已迁移（作为备选），媒体ID: {$thumbMediaId}");
                } else {
                    log_message('warning', "文章 {$article['article_index']} 的 article_image 迁移失败: {$dbPath}");
                }
            }
        }

        log_message('info', "媒体文件迁移完成，共成功迁移 " . count($mediaMapping) . " 个文件");
        return $mediaMapping;
    }

    /**
     * 处理单个媒体文件
     * 将旧文件复制到新位置，并在media表中注册
     * 
     * 路径处理说明：
     * 数据库存储路径：./uploads/file/20241211/filename.png
     * 实际文件位置：./uploads/tmp/file/20241211/filename.png
     * 
     * @return array|null ['media_id' => id, 'old_path' => oldPath, 'new_path' => newPath] or null
     */
    private function processMediaFile(string $oldPath, string $usageType): ?array
    {
        // 检查是否已处理过（避免重复处理相同的文件）
        if (isset($this->migratedMediaLog[$oldPath])) {
            log_message('debug', "文件已处理过，直接返回ID: {$oldPath}");
            // 注意：这里返回的是缓存的媒体ID，需要从结构中提取
            $mediaId = $this->migratedMediaLog[$oldPath];
            if (is_array($mediaId)) {
                return $mediaId;
            }
            // 兼容旧的数据结构（如果缓存的只是ID）
            return ['media_id' => $mediaId, 'old_path' => $oldPath, 'new_path' => null];
        }

        // 获取旧文件的完整路径
        $oldFullPath = $this->convertOldPath($oldPath);
        log_message('debug', "转换后的完整路径: {$oldFullPath}");

        if (!file_exists($oldFullPath)) {
            log_message('warning', "老文件不存在: {$oldPath} -> {$oldFullPath}");
            return null;
        }

        log_message('debug', "文件存在，开始处理: {$oldFullPath}");

        try {
            $file = new File($oldFullPath);
            $extension = strtolower($file->getExtension());
            
            // 获取MIME类型，使用多种方式确保准确性
            $mimeType = $this->getMimeTypeForFile($oldFullPath, $extension);

            // 读取文件信息
            $fileInfo = [
                'original_name' => $file->getBasename(),
                'extension'     => $extension,
                'mime'          => $mimeType,
                'size'          => filesize($oldFullPath),
                'type_group'    => $this->getTypeGroup($mimeType),
            ];
            
            // 如果MIME类型是 application/octet-stream，根据扩展名重新判断type_group
            if ($fileInfo['mime'] === 'application/octet-stream') {
                $typeGroupByExt = $this->getTypeGroup($extension);
                if ($typeGroupByExt !== 'files') {
                    $fileInfo['type_group'] = $typeGroupByExt;
                    log_message('debug', "根据扩展名 {$extension} 判断 type_group 为: {$typeGroupByExt}");
                }
            }

            log_message('debug', "文件信息: " . json_encode($fileInfo));

            // 获取图像尺寸（如果是图片）
            if (strpos($fileInfo['mime'], 'image/') === 0 || $fileInfo['type_group'] === 'images') {
                $imageSize = @getimagesize($oldFullPath);
                if ($imageSize) {
                    $fileInfo['width'] = $imageSize[0];
                    $fileInfo['height'] = $imageSize[1];
                    log_message('debug', "图像尺寸: {$imageSize[0]}x{$imageSize[1]}");
                }
            }

            // 生成新的存储路径（按日期分组）
            $newFileName = time() . '_' . bin2hex(random_bytes(4)) . '.' . $fileInfo['extension'];
            $newDirDate = date('Y/m/d');
            $newRelativePath = "uploads/articles/{$newDirDate}/{$newFileName}";
            $newFullPath = $this->uploadPath . $newDirDate;

            // 创建目录
            if (!is_dir($newFullPath)) {
                @mkdir($newFullPath, 0750, true);
                log_message('debug', "创建目录: {$newFullPath}");
            }
            
            // 复制文件
            $destination = $newFullPath . '/' . $newFileName;
            if (!copy($oldFullPath, $destination)) {
                log_message('error', "文件复制失败: {$oldFullPath} -> {$destination}");
                return null;
            }

            log_message('debug', "文件复制成功: {$destination}");

            // 在media表注册文件
            $mediaData = array_merge($fileInfo, [
                'path'       => $newRelativePath,
                'is_used'    => 1,
                'public'     => 1,
                'created_by' => $this->systemUserId,
            ]);

            log_message('debug', "准备插入media表: " . json_encode($mediaData));

            if (!$this->MediaModel->insert($mediaData)) {
                log_message('error', "媒体注册失败: " . json_encode($this->MediaModel->errors()));
                @unlink($destination);
                return null;
            }

            $mediaId = $this->MediaModel->getInsertID();
            
            if (empty($mediaId)) {
                log_message('error', "媒体插入后获取ID失败");
                @unlink($destination);
                return null;
            }

            $result = [
                'media_id' => $mediaId,
                'old_path' => $oldPath,
                'new_path' => $newRelativePath,
            ];
            
            $this->migratedMediaLog[$oldPath] = $result;

            log_message('info', "媒体迁移成功: {$oldPath} -> ID: {$mediaId}, 新路径: {$newRelativePath}");
            return $result;

        } catch (\Throwable $e) {
            log_message('error', "处理媒体文件异常: " . $e->getMessage());
            return null;
        }
    }

    /**
     * ========== 第二步：迁移文章数据 ==========
     * @return array ['old_article_index' => 'new_article_id', ...]
     * 
     * 说明：
     * - 只使用 article_big_image 作为缩略图（被映射为 thumbnail_id）
     * - 忽略 article_image 字段
     */
    public function migrateArticles(array $mediaMapping = []): array
    {
        $db = Database::connect();
        $db->transBegin();

        try {
            // 在迁移期间禁用验证，因为 category_id 可能为 NULL（分类不存在）
            $this->ArticlesModel->skipValidation(true);
            $this->ArticlesLangModel->skipValidation(true);
            
            $oldArticles = $db->table('taxonomy_article')
                ->select('article_index, article_title, category_index, article_big_image, article_image, article_content, article_created_time')
                ->get()
                ->getResultArray();
            
            if (empty($oldArticles)) {
                log_message('warning', "没有文章数据需要迁移");
                // 恢复验证
                $this->ArticlesModel->skipValidation(false);
                $this->ArticlesLangModel->skipValidation(false);
                $db->transCommit();
                return [];
            }

            $articlesMapping = [];
            $defaultLocale = config('App')->defaultLocale ?? 'en';

            foreach ($oldArticles as $oldArticle) {
                // 从映射表获取新的媒体ID（优先使用 article_big_image，如果为空则使用 article_image）
                $thumbnailId = null;
                $imageField = null;
                
                // 优先使用 article_big_image
                if (!empty($oldArticle['article_big_image'])) {
                    $imageField = $oldArticle['article_big_image'];
                } elseif (!empty($oldArticle['article_image'])) {
                    // 如果 article_big_image 为空，则使用 article_image 作为备选
                    $imageField = $oldArticle['article_image'];
                }
                
                // 如果找到了图片字段，尝试获取对应的媒体ID
                if (!empty($imageField) && isset($mediaMapping[$imageField])) {
                    $thumbnailId = $mediaMapping[$imageField];
                }

                // 生成slug
                helper('url');
                $baseSlug = url_title($oldArticle['article_title'], '-', true);
                if (empty($baseSlug)) {
                    $baseSlug = "article";
                }

                // 提取摘要（前200个字符）
                $excerpt = $this->extractExcerpt($oldArticle['article_content'], 200);

                // 转换时间戳为日期时间
                $createdAt = !empty($oldArticle['article_created_time']) 
                    ? date('Y-m-d H:i:s', (int)$oldArticle['article_created_time'])
                    : date('Y-m-d H:i:s');

                // 从分类映射表获取新的分类ID
                // 如果旧分类在新系统中找不到对应的分类，category_id 将为 NULL
                $categoryId = $this->getCategoryId($oldArticle['category_index']);

                // 准备文章主表数据
                $articleData = [
                    'default_title' => $oldArticle['article_title'],
                    'slug'          => $baseSlug,  // 后续会自动添加ID
                    'excerpt'       => $excerpt,
                    'thumbnail_id'  => $thumbnailId,
                    'category_id'   => $categoryId,
                    'view_count'    => 0,
                    'active'        => 1,
                    'is_main'       => 0,
                    'is_fixed'      => 0,
                    'featured'      => 0,
                    'published_ip'  => '0.0.0.0',
                    'sequence'      => 0,
                    'created_by'    => $this->systemUserId,
                    'updated_by'    => $this->systemUserId,
                    'created_at'    => $createdAt,
                ];

                // 插入文章主表
                if (!$this->ArticlesModel->insert($articleData)) {
                    throw new \RuntimeException(
                        "文章主表插入失败: " . json_encode($this->ArticlesModel->errors())
                    );
                }

                $newArticleId = $this->ArticlesModel->getInsertID();
                
                // 检查 ID 是否有效
                if (empty($newArticleId)) {
                    throw new \RuntimeException(
                        "文章插入后获取ID失败，数据: " . json_encode($articleData)
                    );
                }

                // 生成最终slug（slug-id）
                $finalSlug = $baseSlug . '-' . $newArticleId;
                $this->ArticlesModel->update($newArticleId, ['slug' => $finalSlug]);

                // 准备多语言记录
                $langData = [
                    'article_id'      => $newArticleId,
                    'lang'            => $defaultLocale,
                    'title'           => $oldArticle['article_title'],
                    'content_html'    => $oldArticle['article_content'],
                    'content_delta'   => $this->convertHtmlToDelta($oldArticle['article_content']),
                    'meta_title'      => $oldArticle['article_title'],
                    'meta_description' => $excerpt,
                    'created_by'      => $this->systemUserId,
                    'updated_by'      => $this->systemUserId,
                ];

                // 插入多语言记录
                if (!$this->ArticlesLangModel->insert($langData)) {
                    throw new \RuntimeException(
                        "文章语言记录插入失败: " . json_encode($this->ArticlesLangModel->errors())
                    );
                }

                // 记录文章ID映射
                $articlesMapping[$oldArticle['article_index']] = $newArticleId;

                log_message('info', "文章迁移成功: 旧INDEX {$oldArticle['article_index']} -> 新ID {$newArticleId}");
            }

            // 恢复验证
            $this->ArticlesModel->skipValidation(false);
            $this->ArticlesLangModel->skipValidation(false);
            
            $db->transCommit();
            
            // 处理文章内容中的HTML图片
            log_message('info', "开始处理文章内容中的HTML图片");
            $this->processContentImages($oldArticles, $articlesMapping);
            
            return $articlesMapping;

        } catch (\Throwable $e) {
            // 恢复验证
            $this->ArticlesModel->skipValidation(false);
            $this->ArticlesLangModel->skipValidation(false);
            
            $db->transRollback();
            log_message('error', "文章迁移失败: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * ========== 第三步：创建媒体关系 ==========
     * 
     * 说明：
     * - 基于 articles.thumbnail_id 创建媒体关系
     * - 确保每个有缩略图的文章都有对应的媒体关系记录
     */
    public function createMediaRelations(array $articlesMapping, array $mediaMapping): void
    {
        $db = Database::connect();
        $db->transBegin();

        try {
            // 方法1：从 articles 表直接获取所有有 thumbnail_id 的文章
            $articlesWithThumbnail = $db->table('articles')
                ->select('id, thumbnail_id')
                ->where('thumbnail_id IS NOT NULL', null, false)
                ->get()
                ->getResultArray();
            
            $relationsCreated = 0;

            foreach ($articlesWithThumbnail as $article) {
                $articleId = $article['id'];
                $thumbnailMediaId = $article['thumbnail_id'];

                // 检查是否已经存在这个关系
                $existingRelation = $db->table('media_relations')
                    ->where('media_id', $thumbnailMediaId)
                    ->where('owner_type', 'article')
                    ->where('owner_id', $articleId)
                    ->countAllResults();

                if ($existingRelation > 0) {
                    log_message('debug', "文章 {$articleId} 的缩略图关系已存在，跳过");
                    continue;
                }

                // 创建缩略图关系
                $result = $this->MediaRelationsModel->insert([
                    'media_id'   => $thumbnailMediaId,
                    'owner_type' => 'article',
                    'owner_id'   => $articleId,
                    'usage_type' => 'thumbnail',
                    'sort'       => 1,
                ]);

                if (!$result) {
                    log_message('error', "创建媒体关系失败 - 文章ID: {$articleId}, 媒体ID: {$thumbnailMediaId}, 错误: " . json_encode($this->MediaRelationsModel->errors()));
                    continue;
                }

                $relationsCreated++;
                log_message('debug', "文章 {$articleId} 的缩略图关系已创建 (媒体ID: {$thumbnailMediaId})");
            }

            $db->transCommit();
            log_message('info', "媒体关系创建完成，共创建 {$relationsCreated} 条关系");

        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', "媒体关系创建失败: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * ========== 验证迁移结果 ==========
     */
    public function verifyMigration(): array
    {
        $oldArticleCount = $this->OldArticleModel->countAll();
        $newArticleCount = $this->ArticlesModel->countAll();
        $mediaCount = $this->MediaModel->countAll();
        $relationsCount = $this->MediaRelationsModel->countAll();

        $issues = [];

        // 检查文章数量是否一致
        if ($newArticleCount != $oldArticleCount) {
            $issues[] = "文章数量不匹配: 旧系统 {$oldArticleCount} 条 vs 新系统 {$newArticleCount} 条";
        }

        // 检查是否所有文章都有缩略图
        $db = Database::connect();
        $articlesWithoutThumbnail = $db->table('articles')
            ->where('thumbnail_id', null)
            ->countAllResults();

        if ($articlesWithoutThumbnail > 0) {
            $issues[] = "有 {$articlesWithoutThumbnail} 篇文章缺少缩略图";
        }

        // 检查是否所有文章都有多语言记录
        $articlesWithoutLang = $db->table('articles a')
            ->select('COUNT(a.id) as cnt')
            ->where('NOT EXISTS (SELECT 1 FROM articles_lang al WHERE al.article_id = a.id)', null, false)
            ->get()
            ->getRow();

        if ($articlesWithoutLang && $articlesWithoutLang->cnt > 0) {
            $issues[] = "有 {$articlesWithoutLang->cnt} 篇文章缺少语言记录";
        }

        // 检查媒体关系完整性
        $mediaWithoutRelations = $db->table('media m')
            ->select('COUNT(m.id) as cnt')
            ->where('m.is_used', 1)
            ->where('NOT EXISTS (SELECT 1 FROM media_relations mr WHERE mr.media_id = m.id)', null, false)
            ->get()
            ->getRow();

        if ($mediaWithoutRelations && $mediaWithoutRelations->cnt > 0) {
            $issues[] = "有 {$mediaWithoutRelations->cnt} 个媒体文件没有关联关系";
        }

        return [
            'success'           => empty($issues),
            'oldArticleCount'   => $oldArticleCount,
            'newArticleCount'   => $newArticleCount,
            'mediaCount'        => $mediaCount,
            'relationsCount'    => $relationsCount,
            'issues'            => $issues,
        ];
    }

    /**
     * ========== 辅助方法 ==========
     */

    /**
     * 从HTML中提取摘要
     */
    private function extractExcerpt(string $html, int $length = 200): string
    {
        // 移除HTML标签
        $text = strip_tags($html);
        // 移除多余空格
        $text = preg_replace('/\s+/', ' ', $text);
        // 移除首尾空格
        $text = trim($text);
        // 截取指定长度
        $excerpt = mb_substr($text, 0, $length);

        // 如果被截断，添加省略号
        if (mb_strlen($text) > $length) {
            $excerpt = rtrim($excerpt) . '...';
        }

        return $excerpt;
    }

    /**
     * 将HTML转换为Quill Delta格式
     * 这是一个简化版本，仅保留基本的HTML转换
     */
    private function convertHtmlToDelta(string $html): string
    {
        // 简化版本：直接将HTML作为文本内容保存
        // 实际应用中可能需要更复杂的HTML解析和转换逻辑
        // 或者使用专门的HTML2Delta库

        // 移除多余的空格
        $html = preg_replace('/\s+/', ' ', trim($html));

        // 基本的Delta结构
        $delta = [
            'ops' => [
                ['insert' => $html]
            ]
        ];

        return json_encode($delta);
    }

    /**
     * 获取文件类型分组
     * 支持根据MIME类型或扩展名判断文件类型
     */
    private function getTypeGroup(string $mimeOrExtension): string
    {
        // 移除可能的点号（如果是扩展名）
        $ext = ltrim($mimeOrExtension, '.');
        
        // 判断是否是MIME类型（包含/）
        if (strpos($mimeOrExtension, '/') !== false) {
            // 这是MIME类型
            $mime = $mimeOrExtension;
            
            if (strpos($mime, 'image/') === 0) {
                return 'images';
            } elseif (strpos($mime, 'video/') === 0) {
                return 'videos';
            } elseif (strpos($mime, 'audio/') === 0) {
                return 'audios';
            }
            
            // 如果是 application/octet-stream，需要根据上下文判断
            // 这种情况下应该查看文件扩展名
            return 'files';
        }
        
        // 这是文件扩展名，根据扩展名判断类型
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'ico', 'tiff'];
        $videoExtensions = ['mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv', 'webm', 'm4v'];
        $audioExtensions = ['mp3', 'm4a', 'wav', 'flac', 'aac', 'ogg', 'wma'];
        
        $ext = strtolower($ext);
        
        if (in_array($ext, $imageExtensions)) {
            return 'images';
        } elseif (in_array($ext, $videoExtensions)) {
            return 'videos';
        } elseif (in_array($ext, $audioExtensions)) {
            return 'audios';
        }
        
        return 'files';
    }

    /**
     * 获取系统用户ID
     * 优先获取管理员用户，如果没有则使用ID最小的用户
     */
    private function getSystemUserId(): int
    {
        try {
            $db = Database::connect();

            // 尝试获取超级管理员（shield的admin）
            $admin = $db->table('users')
                ->select('users.id')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
                ->where('auth_groups_users.group', 'admin')
                ->orderBy('users.id', 'ASC')
                ->limit(1)
                ->get()
                ->getRow();

            if ($admin && isset($admin->id)) {
                return (int) $admin->id;
            }

            // 如果没有admin，获取最早创建的用户
            $user = $db->table('users')
                ->select('id')
                ->orderBy('id', 'ASC')
                ->limit(1)
                ->get()
                ->getRow();

            if ($user && isset($user->id)) {
                return (int) $user->id;
            }

            // 如果都找不到，使用默认值 1
            log_message('warning', "未找到用户记录，使用默认用户ID 1");
            return 1;

        } catch (\Throwable $e) {
            log_message('warning', "获取系统用户ID失败: " . $e->getMessage() . "，使用默认ID 1");
            return 1;
        }
    }

    /**
     * 获取迁移统计信息
     */
    public function getMigrationStats(): array
    {
        return [
            'old_articles'    => $this->OldArticleModel->countAll(),
            'new_articles'    => $this->ArticlesModel->countAll(),
            'media_files'     => $this->MediaModel->countAll(),
            'media_relations' => $this->MediaRelationsModel->countAll(),
            'migrated_media'  => count($this->migratedMediaLog),
        ];
    }

    /**
     * 转换旧路径到实际文件位置
     * 支持多种路径格式：
     * - file:    ./uploads/file/20241211/filename.png -> ./uploads/tmp/file/20241211/filename.png
     * - crop:    ./uploads/crop/20241213/crop_xxx.jpeg -> ./uploads/tmp/crop/20241213/crop_xxx.jpeg
     * - article: ./uploads/article/YYYYMMDD/filename.png -> ./uploads/tmp/article/YYYY/MM/DD/filename.png
     */
    private function convertOldPath(string $dbPath): string
    {
        // 规范化路径分隔符为正斜杠
        $dbPath = str_replace('\\', '/', $dbPath);
        
        // 移除开头的 ./
        $path = ltrim($dbPath, './');
        
        // 尝试方案 1：处理 article 路径
        // 格式转换: uploads/article/YYYYMMDD/filename -> uploads/tmp/article/YYYY/MM/DD/filename
        if (strpos($path, 'uploads/article/') !== false) {
            // 提取日期和文件名
            // 例如: uploads/article/20250110/123.jpg
            if (preg_match('/uploads\/article\/(\d{4})(\d{2})(\d{2})\/(.+)$/', $path, $matches)) {
                $year = $matches[1];
                $month = $matches[2];
                $day = $matches[3];
                $filename = $matches[4];
                $newPath = "uploads/tmp/article/{$year}/{$month}/{$day}/{$filename}";
                $fullPath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $newPath);
                
                if (file_exists($fullPath)) {
                    log_message('debug', "文件路径转换成功（article方案）: {$dbPath} -> {$fullPath}");
                    return $fullPath;
                }
            }
            
            // 如果正则不匹配，尝试直接转换到 tmp/article
            $tmpPath = str_replace('uploads/article/', 'uploads/tmp/article/', $path);
            $fullPath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $tmpPath);
            if (file_exists($fullPath)) {
                log_message('debug', "文件路径转换成功（article简单转换）: {$dbPath} -> {$fullPath}");
                return $fullPath;
            }
        }
        
        // 尝试方案 2：处理 file 路径
        $tmpPath = str_replace('uploads/file/', 'uploads/tmp/file/', $path);
        $fullPath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $tmpPath);
        
        if (file_exists($fullPath)) {
            log_message('debug', "文件路径转换成功（file方案）: {$dbPath} -> {$fullPath}");
            return $fullPath;
        }
        
        // 尝试方案 3：处理 crop 路径
        $cropPath = str_replace('uploads/crop/', 'uploads/tmp/crop/', $path);
        $cropFullPath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $cropPath);
        
        if (file_exists($cropFullPath)) {
            log_message('debug', "文件路径转换成功（crop方案）: {$dbPath} -> {$cropFullPath}");
            return $cropFullPath;
        }
        
        // 尝试方案 4：直接使用原路径
        $directPath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $path);
        if (file_exists($directPath)) {
            log_message('debug', "文件路径转换成功（直接路径）: {$dbPath} -> {$directPath}");
            return $directPath;
        }
        
        // 所有方案都失败
        log_message('debug', "文件路径转换（未找到文件）: {$dbPath}");
        return $directPath;
    }

    /**
     * 构建分类映射表
     * 通过匹配旧分类名称（taxonomy_name）与新分类名称（title）来创建映射
     * 
     * @return array [old_category_index => new_category_id, ...]
     */
    private function buildCategoryMapping(): array
    {
        try {
            $mapping = [];
            
            // 获取所有旧分类
            $oldCategories = $this->OldCategoryModel->findAll();
            if (empty($oldCategories)) {
                log_message('info', "旧系统没有分类数据");
                return $mapping;
            }

            log_message('info', "开始构建分类映射，旧系统有 " . count($oldCategories) . " 个分类");

            // 获取所有新分类
            $newCategories = $this->CategoryModel->findAll();
            if (empty($newCategories)) {
                log_message('warning', "新系统没有分类数据");
                return $mapping;
            }

            log_message('info', "新系统有 " . count($newCategories) . " 个分类");

            // 创建新分类名称到ID的映射
            $newCategoryMap = [];
            foreach ($newCategories as $category) {
                $newCategoryMap[$category['title']] = $category['id'];
            }

            // 匹配旧分类到新分类
            foreach ($oldCategories as $oldCategory) {
                $oldCategoryName = $oldCategory['taxonomy_name'];
                $oldCategoryIndex = $oldCategory['taxonomy_index'];

                if (isset($newCategoryMap[$oldCategoryName])) {
                    $mapping[$oldCategoryIndex] = $newCategoryMap[$oldCategoryName];
                    log_message('info', "分类映射: {$oldCategoryName} (INDEX {$oldCategoryIndex}) -> ID {$newCategoryMap[$oldCategoryName]}");
                } else {
                    log_message('warning', "旧分类 '{$oldCategoryName}' (INDEX {$oldCategoryIndex}) 在新系统中找不到对应分类，该分类将被设置为 NULL");
                }
            }

            log_message('info', "分类映射构建完成，共映射 " . count($mapping) . " 个分类");
            return $mapping;

        } catch (\Throwable $e) {
            log_message('error', "构建分类映射失败: " . $e->getMessage());
            return [];
        }
    }

    /**
     * 处理文章内容中的HTML图片
     * 提取 <img> 标签中的 src 属性，将图片迁移到media表并创建关系
     * 
     * 说明：
     * - 从 article_content 的HTML中提取所有 <img> 的 src 属性
     * - 将提取的图片迁移到 media 表
     * - 创建 media_relations 关系记录
     * - 同步更新 media.is_used 标记
     */
    private function processContentImages(array $oldArticles, array $articlesMapping): void
    {
        $db = Database::connect();
        $db->transBegin();

        try {
            $processedCount = 0;
            $relationCount = 0;
            $processedImagePaths = []; // 跟踪已处理的图片路径，避免重复处理
            $imagePathMapping = []; // 映射：原始路径 -> 新路径

            foreach ($oldArticles as $oldArticle) {
                $oldArticleIndex = $oldArticle['article_index'];
                $newArticleId = $articlesMapping[$oldArticleIndex] ?? null;

                if (empty($newArticleId)) {
                    log_message('debug', "文章 {$oldArticleIndex} 未找到新ID，跳过HTML图片处理");
                    continue;
                }

                // 提取HTML中的图片
                $imageSources = $this->extractImageSources($oldArticle['article_content']);

                if (empty($imageSources)) {
                    log_message('debug', "文章 {$oldArticleIndex} 内容中未找到图片");
                    continue;
                }

                log_message('info', "文章 {$oldArticleIndex} 的内容中发现 " . count($imageSources) . " 个图片");

                foreach ($imageSources as $imagePath) {
                    // 规范化图片路径
                    $normalizedPath = $this->normalizeImagePath($imagePath);
                    
                    if (empty($normalizedPath)) {
                        log_message('warning', "无法规范化图片路径: {$imagePath}");
                        continue;
                    }

                    // 检查是否已处理过这个文件（避免重复处理）
                    if (isset($processedImagePaths[$normalizedPath])) {
                        $mediaId = $processedImagePaths[$normalizedPath];
                        log_message('debug', "图片已处理过: {$normalizedPath} (ID: {$mediaId})");
                    } else {
                        // 处理图片文件
                        $result = $this->processMediaFile($normalizedPath, 'content');
                        
                        if (!$result || !isset($result['media_id'])) {
                            log_message('warning', "无法处理图片: {$normalizedPath}");
                            continue;
                        }
                        
                        $mediaId = $result['media_id'];
                        $processedImagePaths[$normalizedPath] = $mediaId;
                        
                        // 记录路径映射（用于后续更新HTML）
                        if (isset($result['old_path']) && isset($result['new_path'])) {
                            $imagePathMapping[$result['old_path']] = $result['new_path'];
                        }
                        
                        $processedCount++;
                    }

                    // 创建媒体关系
                    if ($mediaId) {
                        $relationData = [
                            'media_id'    => $mediaId,
                            'owner_type'  => 'article',
                            'owner_id'    => $newArticleId,
                            'usage_type'  => 'content',
                            'sort'        => $relationCount + 1,
                        ];

                        if ($this->MediaRelationsModel->insert($relationData)) {
                            $relationCount++;
                            log_message('info', "为文章 {$newArticleId} 创建了媒体关系: 媒体ID {$mediaId}");
                        } else {
                            log_message('warning', "创建媒体关系失败: " . json_encode($this->MediaRelationsModel->errors()));
                        }
                    }
                }
            }

            $db->transCommit();
            
            // 同步所有已处理图片的 media.is_used 标记为1
            if (!empty($processedImagePaths)) {
                $mediaIds = array_values($processedImagePaths);
                $this->MediaModel->whereIn('id', $mediaIds)->set(['is_used' => 1])->update();
                log_message('info', "同步更新了 " . count($mediaIds) . " 个媒体文件的 is_used 标记");
            }
            
            // 更新文章HTML内容中的图片路径
            if (!empty($imagePathMapping)) {
                $this->updateArticlesLangContent($articlesMapping, $imagePathMapping);
            }
            
            log_message('info', "HTML图片处理完成: 处理 {$processedCount} 个文件，创建 {$relationCount} 个关系");

        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', "HTML图片处理失败: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 更新文章语言表中的HTML内容
     * 将旧的图片路径替换为新的图片路径
     * 
     * @param array $articlesMapping [old_article_index => new_article_id]
     * @param array $imagePathMapping [old_path => new_path]
     */
    private function updateArticlesLangContent(array $articlesMapping, array $imagePathMapping): void
    {
        $db = Database::connect();
        $db->transBegin();

        try {
            $updateCount = 0;

            // 获取所有需要更新的文章ID列表
            $newArticleIds = array_values($articlesMapping);
            
            if (empty($newArticleIds)) {
                log_message('warning', "没有可用的新文章ID，跳过HTML内容更新");
                return;
            }

            // 获取所有articles_lang记录
            $articlesLang = $this->ArticlesLangModel->whereIn('article_id', $newArticleIds)->findAll();

            foreach ($articlesLang as $langRecord) {
                $contentHtml = $langRecord['content_html'] ?? '';
                
                if (empty($contentHtml)) {
                    continue;
                }

                $originalContent = $contentHtml;
                
                // 对每个路径映射进行替换
                foreach ($imagePathMapping as $oldPath => $newPath) {
                    $newPathRelative = ltrim($newPath, './');
                    
                    // 提取基础路径部分（可能的多种格式）
                    // oldPath 来自 normalizeImagePath，总是 ./uploads/article/... 或 ./uploads/file/... 格式
                    // 但HTML中可能是：./uploads/article/... 、uploads/article/... 、/uploads/article/...
                    
                    // 从 ./uploads/article/20250110/... 中提取 uploads/article/20250110/...
                    $basePath = $oldPath;
                    if (strpos($basePath, './') === 0) {
                        $basePath = substr($basePath, 2);
                    }
                    
                    // 替换所有可能的格式
                    // 1. ./ 前缀版本
                    $contentHtml = str_replace('./' . $basePath, $newPathRelative, $contentHtml);
                    // 2. 无前缀版本
                    $contentHtml = str_replace($basePath, $newPathRelative, $contentHtml);
                    // 3. / 前缀版本
                    $contentHtml = str_replace('/' . $basePath, $newPathRelative, $contentHtml);
                }

                // 如果内容有变化，更新数据库
                if ($contentHtml !== $originalContent) {
                    $updateData = [
                        'content_html' => $contentHtml,
                    ];

                    // 同时更新content_delta（如果需要）
                    $deltaData = $this->convertHtmlToDelta($contentHtml);
                    if (!empty($deltaData)) {
                        $updateData['content_delta'] = $deltaData;
                    }

                    if ($this->ArticlesLangModel->update($langRecord['id'], $updateData)) {
                        $updateCount++;
                        log_message('info', "更新了文章 {$langRecord['article_id']} 的HTML内容");
                    } else {
                        log_message('warning', "更新文章 {$langRecord['article_id']} 的HTML内容失败: " . json_encode($this->ArticlesLangModel->errors()));
                    }
                }
            }

            $db->transCommit();
            log_message('info', "HTML内容更新完成，共更新 {$updateCount} 条记录");

        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', "更新HTML内容失败: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 从HTML内容中提取所有 <img> 标签的 src 属性
     * 返回图片路径数组
     * 
     * 支持多种格式：
     * - src="..." (双引号)
     * - src='...' (单引号)
     * - src=... (无引号)
     * 
     * 过滤条件：
     * - 必须是相对或绝对路径中包含 uploads 的
     * - 去除重复的路径
     * - 排除外部 URL（可选）
     */
    private function extractImageSources(string $html): array
    {
        $imageSources = [];

        // 方案1：匹配 <img ...  src="..." ...>
        $pattern1 = '/<img\s+([^>]*?)\s*src\s*=\s*["\']([^"\']+)["\']([^>]*?)>/i';
        if (preg_match_all($pattern1, $html, $matches)) {
            if (isset($matches[2])) {
                $imageSources = array_merge($imageSources, $matches[2]);
            }
        }

        // 方案2：直接匹配 src="..." 或 src='...'（不需要完整的img标签）
        $pattern2 = '/src\s*=\s*["\']([^"\']+)["\']/i';
        if (preg_match_all($pattern2, $html, $matches)) {
            if (isset($matches[1])) {
                $imageSources = array_merge($imageSources, $matches[1]);
            }
        }

        // 方案3：匹配 src=... (没有引号的情况)
        $pattern3 = '/src\s*=\s*([^\s>\"\']+)/i';
        if (preg_match_all($pattern3, $html, $matches)) {
            if (isset($matches[1])) {
                foreach ($matches[1] as $match) {
                    $src = trim($match, '\'"');
                    if (!empty($src) && strpos($src, '<') === false && strpos($src, '>') === false) {
                        $imageSources[] = $src;
                    }
                }
            }
        }

        // 去重
        $imageSources = array_unique($imageSources);

        // 过滤：只保留有效的图片路径
        $validImageSources = [];
        foreach ($imageSources as $src) {
            $src = trim($src);
            if (empty($src)) {
                continue;
            }

            // 检查是否是上传目录中的文件
            // 支持的格式：
            // - ./uploads/file/... 或 ./uploads/crop/... (数据库格式)
            // - uploads/file/... 或 uploads/crop/... (相对格式)
            // - /uploads/file/... 或 /uploads/crop/... (绝对路径格式)
            // - /uploads/article/... (原系统使用的article目录)
            // - uploads/article/... (相对article目录)
            if (
                strpos($src, './uploads/file/') !== false ||
                strpos($src, './uploads/crop/') !== false ||
                strpos($src, './uploads/article/') !== false ||
                strpos($src, 'uploads/file/') !== false ||
                strpos($src, 'uploads/crop/') !== false ||
                strpos($src, 'uploads/article/') !== false ||
                strpos($src, '/uploads/file/') !== false ||
                strpos($src, '/uploads/crop/') !== false ||
                strpos($src, '/uploads/article/') !== false
            ) {
                $validImageSources[] = $src;
            } else {
                log_message('debug', "过滤掉非uploads目录的图片: {$src}");
            }
        }

        $validImageSources = array_values($validImageSources); // 重新索引数组

        if (!empty($validImageSources)) {
            log_message('info', "从HTML中提取到 " . count($validImageSources) . " 个有效图片");
            if (count($validImageSources) <= 5) {
                log_message('debug', "提取的图片路径: " . json_encode($validImageSources));
            } else {
                log_message('debug', "前5个提取的图片路径: " . json_encode(array_slice($validImageSources, 0, 5)));
            }
        }

        return $validImageSources;
    }

    /**
     * 规范化图片路径
     * 将不同格式的路径转换为统一的格式，便于处理
     * 
     * 支持的输入格式：
     * - ./uploads/file/20241211/filename.png
     * - ./uploads/crop/20241213/crop_xxx.jpeg
     * - ./uploads/article/20241211/filename.png (原系统格式)
     * - uploads/file/...
     * - /uploads/file/...
     * - /uploads/article/...
     * 
     * 输出格式：统一转换为 ./uploads/XXX/... 格式
     */
    private function normalizeImagePath(string $imagePath): string
    {
        $path = trim($imagePath);
        
        if (empty($path)) {
            return '';
        }

        // 规范化路径分隔符为正斜杠
        $path = str_replace('\\', '/', $path);

        // 移除开头的多个 ./
        while (strpos($path, './') === 0) {
            $path = substr($path, 2);
        }
        
        // 移除开头的 /
        $path = ltrim($path, '/');

        // 如果不以 uploads/ 开头，返回空
        if (strpos($path, 'uploads/') !== 0) {
            log_message('debug', "路径不是uploads开头，无法规范化: {$imagePath}");
            return '';
        }

        // 验证路径格式：必须包含 file、crop 或 article
        if (
            strpos($path, 'uploads/file/') !== false ||
            strpos($path, 'uploads/crop/') !== false ||
            strpos($path, 'uploads/article/') !== false
        ) {
            // 添加 ./ 前缀并返回
            return './' . $path;
        }

        log_message('debug', "路径格式不正确（不包含file、crop或article）: {$imagePath}");
        return '';
    }

    /**
     * 获取文件的正确MIME类型
     * 使用多种方式确保准确性
     */
    private function getMimeTypeForFile(string $filePath, string $extension): string
    {
        // 方案1：基于扩展名的MIME类型映射
        $mimeMap = [
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
            'svg'  => 'image/svg+xml',
            'bmp'  => 'image/bmp',
            'ico'  => 'image/x-icon',
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls'  => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'zip'  => 'application/zip',
            'rar'  => 'application/x-rar-compressed',
            'mp3'  => 'audio/mpeg',
            'mp4'  => 'video/mp4',
            'mov'  => 'video/quicktime',
            'avi'  => 'video/x-msvideo',
        ];
        
        $extension = strtolower($extension);
        
        // 如果扩展名在映射表中，先使用映射表的值
        if (isset($mimeMap[$extension])) {
            return $mimeMap[$extension];
        }
        
        // 方案2：使用 finfo_file 函数
        if (function_exists('finfo_file')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $filePath);
            finfo_close($finfo);
            if ($mimeType && $mimeType !== 'application/octet-stream') {
                return $mimeType;
            }
        }
        
        // 方案3：使用 mime_content_type 函数（已弃用但某些系统仍有）
        if (function_exists('mime_content_type')) {
            $mimeType = mime_content_type($filePath);
            if ($mimeType && $mimeType !== 'application/octet-stream') {
                return $mimeType;
            }
        }
        
        // 方案4：使用 CodeIgniter File 类
        try {
            $file = new File($filePath);
            $mimeType = $file->getMimeType();
            if ($mimeType && $mimeType !== 'application/octet-stream') {
                return $mimeType;
            }
        } catch (\Throwable $e) {
            log_message('debug', "File::getMimeType() 失败: " . $e->getMessage());
        }
        
        // 默认返回映射表中的值，或 application/octet-stream
        return $mimeMap[$extension] ?? 'application/octet-stream';
    }

    /**
     * 根据旧分类索引获取新分类ID
     * 如果映射中不存在，则返回 NULL
     */
    private function getCategoryId(?int $oldCategoryIndex): ?int
    {
        if (empty($oldCategoryIndex)) {
            return null;
        }

        return $this->categoryMapping[$oldCategoryIndex] ?? null;
    }
}
