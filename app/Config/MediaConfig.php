<?php

namespace App\Config;

/**
 * 媒体上传与处理配置类
 * 统一管理白名单、限制、路径等配置
 */
class MediaConfig
{
    // ========== MIME 类型白名单 ==========
    public const ALLOWED_MIMES = [
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/zip',
        'application/x-rar-compressed',
        'video/mp4',
        'video/mpeg',
    ];

    // ========== 文件大小限制 ==========
    public const MAX_SIZE_MB = 5;
    public const MAX_SIZE_BYTES = self::MAX_SIZE_MB * 1024 * 1024;

    // ========== 图像限制 ==========
    public const MAX_IMAGE_DIMENSION = 10000; // 单边最大像素
    public const MAX_FAVICON_SIZE = 256;

    // ========== 目录权限 ==========
    public const DIR_PERMISSION = 0750;
    public const FILE_PERMISSION = 0640;

    // ========== 存储路径 ==========
    public const UPLOAD_BASE_DIR = 'uploads';
    public const UPLOAD_ABSOLUTE_PATH = FCPATH . 'uploads/';

    // ========== 媒体类型分类 ==========
    public const TYPE_GROUPS = [
        'images' => 'image/',
        'videos' => 'video/',
        'audios' => 'audio/',
        'files' => 'application/',
    ];

    // ========== 使用类型 ==========
    public const USAGE_TYPES = ['thumbnail', 'gallery', 'content', 'file'];

    // ========== 缓存配置 ==========
    public const CACHE_DURATION = 300; // 秒

    /**
     * 验证 MIME 是否在白名单中
     */
    public static function isAllowedMime(string $mime): bool
    {
        return in_array($mime, self::ALLOWED_MIMES, true);
    }

    /**
     * 根据 MIME 获取文件类型分组
     */
    public static function getTypeGroupByMime(string $mime): string
    {
        foreach (self::TYPE_GROUPS as $group => $prefix) {
            if (str_starts_with($mime, $prefix)) {
                return $group;
            }
        }
        return 'files';
    }
}
