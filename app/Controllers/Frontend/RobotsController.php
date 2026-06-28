<?php

namespace App\Controllers\Frontend;

use CodeIgniter\Controller;

/**
 * Robots Controller
 * 生成robots.txt文件供搜索引擎爬虫遵循
 */
class RobotsController extends Controller
{
    /**
     * 生成 robots.txt
     */
    public function index()
    {
        // 获取当前环境
        $environment = env('CI_ENVIRONMENT', 'production');

        // 开发或测试环境：阻止所有爬虫抓取
        if ($environment !== 'production') {
            $robots = "User-agent: *" . PHP_EOL;
            $robots .= "Disallow: /" . PHP_EOL;

            return $this->response
                ->setContentType('text/plain; charset=UTF-8')
                ->setBody($robots);
        }

        // 生产环境 robots.txt 内容
        $robots = '';

        // 所有爬虫规则
        $robots .= "User-agent: *" . PHP_EOL;
        $robots .= "Disallow: /admin" . PHP_EOL;
        $robots .= "Disallow: /haoadmin" . PHP_EOL;
        $robots .= "Disallow: /app" . PHP_EOL;
        $robots .= "Disallow: /system" . PHP_EOL;
        $robots .= "Disallow: /writable" . PHP_EOL;
        $robots .= "Disallow: /vendor" . PHP_EOL;
        $robots .= "Disallow: /tests" . PHP_EOL;
        $robots .= "Disallow: /*?*" . PHP_EOL;       // 禁止带查询参数的URL
        $robots .= "Disallow: /search" . PHP_EOL;
        $robots .= "Disallow: /api/admin" . PHP_EOL;

        // 禁止特定文件类型
        $robots .= "Disallow: /*.php" . PHP_EOL;
        $robots .= "Disallow: /*.sql" . PHP_EOL;
        $robots .= "Disallow: /*.log" . PHP_EOL;

        $robots .= "Allow: /" . PHP_EOL;
        $robots .= PHP_EOL;

        // Google 爬虫（Crawl-delay 对 Google 不生效，但写上无妨）
        $robots .= "User-agent: Googlebot" . PHP_EOL;
        $robots .= "Allow: /" . PHP_EOL;
        $robots .= "Crawl-delay: 1" . PHP_EOL;
        $robots .= PHP_EOL;

        // Bing 爬虫
        $robots .= "User-agent: Bingbot" . PHP_EOL;
        $robots .= "Allow: /" . PHP_EOL;
        $robots .= "Crawl-delay: 2" . PHP_EOL;
        $robots .= PHP_EOL;

        // Baidu 爬虫
        $robots .= "User-agent: Baiduspider" . PHP_EOL;
        $robots .= "Allow: /" . PHP_EOL;
        $robots .= "Crawl-delay: 1" . PHP_EOL;
        $robots .= PHP_EOL;

        // Naver 爬虫
        $robots .= "User-agent: Naver" . PHP_EOL;
        $robots .= "Allow: /" . PHP_EOL;
        $robots .= "Crawl-delay: 1" . PHP_EOL;
        $robots .= PHP_EOL;

        // Sitemap（使用绝对 URL，更标准）
        $robots .= 'Sitemap: ' . base_url('sitemap.xml', true) . PHP_EOL;

        // 返回文本响应
        return $this->response
            ->setContentType('text/plain; charset=UTF-8')
            ->setBody($robots);
    }
}
