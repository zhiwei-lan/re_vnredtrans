<?php

namespace App\Libraries;

class UserAgentDisplay
{
    public static function format(string $ua): string
    {
        $os      = self::os($ua);
        $browser = self::browser($ua);
        $device  = self::device($ua);

        return "{$os} · {$browser} · {$device}";
    }

    protected static function os(string $ua): string
    {
        return match (true) {
            str_contains($ua, 'Windows NT 10.0') => 'Windows 10',
            str_contains($ua, 'Windows NT 11.0') => 'Windows 11',
            str_contains($ua, 'Mac OS X')         => 'macOS',
            str_contains($ua, 'Android')          => 'Android',
            str_contains($ua, 'iPhone')           => 'iOS (iPhone)',
            str_contains($ua, 'iPad')              => 'iOS (iPad)',
            str_contains($ua, 'Linux')             => 'Linux',
            default                                => '알 수 없는 OS',
        };
    }

    protected static function browser(string $ua): string
    {
        if (preg_match('/Edg\/([\d.]+)/', $ua, $m)) {
            return 'Edge ' . explode('.', $m[1])[0];
        }

        if (preg_match('/Chrome\/([\d.]+)/', $ua, $m)) {
            return 'Chrome ' . explode('.', $m[1])[0];
        }

        if (preg_match('/Firefox\/([\d.]+)/', $ua, $m)) {
            return 'Firefox ' . explode('.', $m[1])[0];
        }

        if (str_contains($ua, 'Safari') && str_contains($ua, 'Version/')) {
            return 'Safari';
        }

        return '알 수 없는 브라우저';
    }

    protected static function device(string $ua): string
    {
        return match (true) {
            str_contains($ua, 'Mobile') => '모바일',
            str_contains($ua, 'Tablet') => '태블릿',
            default                     => '데스크톱',
        };
    }
}