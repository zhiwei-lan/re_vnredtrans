<?php
namespace App\Services;

use Config\App;

class LangService
{
    /**
     * 获取当前用户语言
     *
     * 优先级：
     * 1. Session
     * 2. URL 前缀
     * 3. GET 参数 ?lang=
     * 4. 默认语言
     */
    public static function getLocale(): string
    {
        $session = session();
        $request = service('request');

        // 支持语言列表，从配置文件获取
        $config = new App();
        $supportedLocales = $config->supportedLocales;
        $defaultLocale = config('App')->defaultLocale;

        // 1️⃣ Session 中已有
        if ($session->has('lang') && in_array($session->get('lang'), $supportedLocales)) {
            return $session->get('lang');
        }

        // 2️⃣ URL 前缀，如 /en/home
        $path = trim($request->getUri()->getPath(), '/');
        $segments = explode('/', $path);
        $locale = $segments[0] ?? null;
        if ($locale && in_array($locale, $supportedLocales)) {
            $session->set('lang', $locale);
            return $locale;
        }

        // 3️⃣ GET 参数 ?lang=zh
        $lang = $request->getGet('lang');
        if ($lang && in_array($lang, $supportedLocales)) {
            $session->set('lang', $lang);
            return $lang;
        }

        // 4️⃣ 默认语言
        $session->set('lang', $defaultLocale);
        return $defaultLocale;
    }

    /**
     * 加载语言包
     *
     * @param string $group 语言文件名，如 'Message'
     * @return array
     */
    public static function load(string $group = 'Message'): array
    {
        $locale = self::getLocale();
        return \Config\Services::language($locale)->load($group);
    }

    /**
     * 获取翻译内容
     *
     * @param string $key
     * @param array $params 替换参数
     * @return string
     */
    public static function get(string $key, array $params = []): string
    {
        $lang = \Config\Services::language(self::getLocale());
        return $lang->getLine($key, $params);
    }
}
