<?php

namespace App\Exceptions;

/**
 * 媒体操作专用异常类
 */
class MediaException extends \Exception
{
    public const INVALID_MIME = 1001;
    public const FILE_TOO_LARGE = 1002;
    public const UPLOAD_FAILED = 1003;
    public const INVALID_PATH = 1004;
    public const PNG_INVALID = 1006;
    public const FILE_NOT_FOUND = 1007;
    public const RECORD_NOT_FOUND = 1008;

    public static function invalidMime(string $mime): self
    {
        return new self("Invalid MIME type: {$mime}", self::INVALID_MIME);
    }

    public static function fileTooLarge(int $sizeMb, int $maxMb): self
    {
        return new self("File size {$sizeMb}MB exceeds limit of {$maxMb}MB", self::FILE_TOO_LARGE);
    }

    public static function uploadFailed(string $reason): self
    {
        return new self("Upload failed: {$reason}", self::UPLOAD_FAILED);
    }

    public static function invalidPath(string $path): self
    {
        return new self("Invalid upload path detected: {$path}", self::INVALID_PATH);
    }

    public static function pngInvalid(string $reason = ''): self
    {
        $msg = 'Invalid or corrupted PNG file';
        if ($reason) {
            $msg .= ": {$reason}";
        }
        return new self($msg, self::PNG_INVALID);
    }

    public static function fileNotFound(string $path): self
    {
        return new self("File not found: {$path}", self::FILE_NOT_FOUND);
    }

    public static function recordNotFound(string $type, $id): self
    {
        return new self("{$type} record not found (ID: {$id})", self::RECORD_NOT_FOUND);
    }
}
