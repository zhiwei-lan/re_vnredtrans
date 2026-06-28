<?php

if (! function_exists('redirect_back'))
{
    /**
     * 多站点安全 back 跳转
     *
     * @param string|null $default 默认回跳页（相对路径）
     */
    function redirect_back(string $default = null)
    {
        $siteHost = rtrim(service('site')->host(), '/'); // 当前站点域名
        if($default){
            return redirect()->to($siteHost . '/' . ltrim($default, '/'));
        }

        // 获取上一页
        $prev = session()->get('_ci_previous_url') ?? ($_SERVER['HTTP_REFERER'] ?? null);
        if (empty($prev)) {
            $prev = $siteHost;
        } else {
            // 解析上一页 URL
            $parsed = parse_url($prev);
            $path   = $parsed['path'] ?? '/';
            $query  = isset($parsed['query']) ? '?' . $parsed['query'] : '';
            $prev   = $siteHost . $path . $query;
        }

        return redirect()->to($prev);
    }
}

