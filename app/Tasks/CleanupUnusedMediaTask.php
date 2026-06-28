<?php

namespace App\Tasks;

use App\Models\MediaModel;
use App\Models\MediaRelationsModel;
use App\Services\Backend\MediaService;

class CleanupUnusedMediaTask
{
    protected MediaModel $mediaModel;
    protected MediaRelationsModel $mediaRelationsModel;

    public function __construct()
    {
        $this->mediaModel = new MediaModel();
        $this->mediaRelationsModel = new MediaRelationsModel();
    }

    /**
     * 执行任务：清理未使用的媒体文件
     * - 查找所有 is_used=0 的媒体文件
     * - 检查在 media_relations 中是否真的没有关联
     * - 删除物理文件和数据库记录
     * - 支持清理超过指定天数的文件
     */
    public function execute(): void
    {
        try {
            log_message('info', 'CleanupUnusedMediaTask: Starting cleanup of unused media files');

            // 清理 is_used=0 的孤立文件
            $this->cleanupOrphanedMedia();

            // 清理超过 7 天没有被使用的临时文件
            $this->cleanupTemporaryMedia(7);

            log_message('info', 'CleanupUnusedMediaTask: Cleanup completed successfully');
        } catch (\Throwable $e) {
            log_message('critical', 'CleanupUnusedMediaTask: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
        }
    }

    /**
     * 清理被标记为未使用的孤立文件
     */
    protected function cleanupOrphanedMedia(): void
    {
        try {
            // 查找所有标记为未使用的媒体
            $unusedMedias = $this->mediaModel
                ->where('is_used', 0)
                ->findAll();

            if (empty($unusedMedias)) {
                log_message('debug', 'CleanupUnusedMediaTask: No orphaned media found');
                return;
            }

            log_message('info', 'CleanupUnusedMediaTask: Found ' . count($unusedMedias) . ' unused media files');

            $deleted = 0;
            $failed = 0;

            $mediaIdsToDelete = [];

            foreach ($unusedMedias as $media) {
                try {
                    // 双重确认：检查 media_relations 中是否有关联
                    $hasRelations = $this->mediaRelationsModel
                        ->where('media_id', $media['id'])
                        ->first();

                    if ($hasRelations !== null) {
                        // 如果还有关联，标记为已使用
                        $this->mediaModel->update($media['id'], ['is_used' => 1]);
                        log_message('debug', 'CleanupUnusedMediaTask: Media #' . $media['id'] . ' has relations, marked as used');
                        continue;
                    }

                    // 删除物理文件
                    $this->deleteMediaFile($media);
                    $mediaIdsToDelete[] = $media['id'];
                    $deleted++;
                } catch (\Throwable $e) {
                    $failed++;
                    log_message('warning', 'CleanupUnusedMediaTask: Failed to delete media #' . $media['id'] . ': ' . $e->getMessage());
                }
            }

            // 删除数据库记录（仅删除成功删除物理文件的记录）
            if (!empty($mediaIdsToDelete)) {
                $this->mediaModel->whereIn('id', $mediaIdsToDelete)->delete();
                log_message('info', 'CleanupUnusedMediaTask: Deleted ' . count($mediaIdsToDelete) . ' unused media files, Failed: ' . $failed);
            }
        } catch (\Throwable $e) {
            log_message('error', 'CleanupUnusedMediaTask: Error cleaning orphaned media: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 清理超过指定天数的临时上传文件
     * 用于清理已上传但长期未使用的文件
     * 
     * @param int $daysOld 天数，默认 7 天
     */
    protected function cleanupTemporaryMedia(int $daysOld = 7): void
    {
        try {
            $cutoffDate = date('Y-m-d H:i:s', strtotime("-{$daysOld} days"));

            // 查找超过 X 天没有被使用且没有关联的媒体
            $oldUnusedMedias = $this->mediaModel
                ->where('is_used', 0)
                ->where('created_at <', $cutoffDate)
                ->findAll();

            if (empty($oldUnusedMedias)) {
                log_message('debug', 'CleanupUnusedMediaTask: No temporary media older than ' . $daysOld . ' days');
                return;
            }

            log_message('info', 'CleanupUnusedMediaTask: Found ' . count($oldUnusedMedias) . ' old temporary media files');

            $deleted = 0;
            $failed = 0;
            $mediaIdsToDelete = [];

            foreach ($oldUnusedMedias as $media) {
                try {
                    // 检查是否有关联
                    $hasRelations = $this->mediaRelationsModel
                        ->where('media_id', $media['id'])
                        ->first();

                    if ($hasRelations !== null) {
                        // 如果有关联，标记为已使用
                        $this->mediaModel->update($media['id'], ['is_used' => 1]);
                        continue;
                    }

                    // 删除物理文件
                    $this->deleteMediaFile($media);
                    $mediaIdsToDelete[] = $media['id'];
                    $deleted++;
                } catch (\Throwable $e) {
                    $failed++;
                    log_message('warning', 'CleanupUnusedMediaTask: Failed to delete old media #' . $media['id'] . ': ' . $e->getMessage());
                }
            }

            // 删除数据库记录（仅删除成功删除物理文件的记录）
            if (!empty($mediaIdsToDelete)) {
                $this->mediaModel->whereIn('id', $mediaIdsToDelete)->delete();
                log_message('info', 'CleanupUnusedMediaTask: Deleted ' . count($mediaIdsToDelete) . ' old unused media files, Failed: ' . $failed);
            }
        } catch (\Throwable $e) {
            log_message('error', 'CleanupUnusedMediaTask: Error cleaning temporary media: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 删除媒体文件
     * 包含路径验证和错误处理
     */
    protected function deleteMediaFile(array $media): void
    {
        $filePath = FCPATH . ltrim($media['path'], '/');

        // 路径安全检查（防止目录遍历）
        $realPath = realpath(dirname($filePath));
        $allowedDir = realpath(FCPATH . ltrim(\App\Config\MediaConfig::UPLOAD_BASE_DIR, '/'));

        if ($realPath === false || !str_starts_with($realPath, (string) $allowedDir)) {
            throw new \RuntimeException('Invalid media path detected: ' . $media['path']);
        }

        // 删除物理文件
        if (is_file($filePath)) {
            if (!@unlink($filePath)) {
                throw new \RuntimeException('Failed to delete file: ' . $filePath);
            }
            log_message('debug', 'CleanupUnusedMediaTask: Deleted file ' . $filePath);
        }
    }
}
