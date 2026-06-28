<?php

namespace App\Controllers\Frontend;

use CodeIgniter\Controller;
use App\Models\ArticlesModel;
use App\Models\CategoryModel;
use App\Models\NavigationModel;

/**
 * Sitemap Controller
 * 生成网站地图供搜索引擎抓取
 */
class SitemapController extends Controller
{
    protected ArticlesModel $ArticlesModel;
    protected CategoryModel $CategoryModel;
    protected NavigationModel $NavigationModel;

    public function __construct()
    {
        $this->ArticlesModel = new ArticlesModel();
        $this->CategoryModel = new CategoryModel();
        $this->NavigationModel = new NavigationModel();
    }

    /**
     * 生成 XML Sitemap
     * 
     * 包含：
     * - 首页
     * - 所有活跃分类页面
     * - 所有活跃文章
     * - 重要静态页面
     */
    public function index()
    {
        $cache = cache();
        $cacheKey = 'sitemap_xml';
        $locale = config('App')->defaultLocale;
        // 1小时缓存，可根据站点更新频率调整
        $xml = $cache->get($cacheKey);
        if ($xml !== null) {
            return $this->response
                ->setContentType('application/xml; charset=UTF-8')
                ->setBody($xml);
        }

        // --------------------------
        // 数据收集逻辑
        // --------------------------
        $urls = [];

        // 首页
        $urls[] = [
            'loc'        => base_url('/'),
            'lastmod'    => $this->formatLastmod(date('Y-m-d')),
            'changefreq' => 'weekly',
            'priority'   => '1.0',
        ];

        // 分类页面
        // $categories = $this->getActiveCategories();
        // foreach ($categories as $category) {
        //     $urls[] = [
        //         'loc'        => base_url("{$locale}/article/{$category['id']}/{$this->slugify($category['title'])}"),
        //         'lastmod'    => $this->formatLastmod($category['updated_at'] ?? date('Y-m-d')),
        //         'changefreq' => 'weekly',
        //         'priority'   => '0.8',
        //     ];
        // }

        // 文章页面
        $articles = $this->getPublishedArticles();
        foreach ($articles as $article) {
            $urls[] = [
                'loc'        => base_url("{$locale}/article/62/detail/{$article['slug']}/{$article['id']}"),
                'lastmod'    => $this->formatLastmod($article['updated_at'] ?? $article['created_at'] ?? date('Y-m-d')),
                'changefreq' => 'weekly',
                'priority'   => '0.6',
            ];
        }

        // 导航页面
        $navigationPages = $this->getActiveNavigationPages();
        foreach ($navigationPages as $navPage) {
            $urls[] = [
                'loc'        => base_url("{$locale}/{$navPage['url']}"),
                'lastmod'    => $this->formatLastmod($navPage['updated_at'] ?? date('Y-m-d')),
                'changefreq' => 'monthly',
                'priority'   => '0.7',
            ];
        }

        // 生成 XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        foreach ($urls as $url) {
            $xml .= '    <url>' . PHP_EOL;
            $xml .= '        <loc>' . htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8') . '</loc>' . PHP_EOL;
            $xml .= '        <lastmod>' . htmlspecialchars($url['lastmod'], ENT_XML1, 'UTF-8') . '</lastmod>' . PHP_EOL;
            $xml .= '        <changefreq>' . htmlspecialchars($url['changefreq'], ENT_XML1, 'UTF-8') . '</changefreq>' . PHP_EOL;
            $xml .= '        <priority>' . htmlspecialchars($url['priority'], ENT_XML1, 'UTF-8') . '</priority>' . PHP_EOL;
            $xml .= '    </url>' . PHP_EOL;
        }
        $xml .= '</urlset>';

        // 写入缓存 3600秒（1小时）
        //$cache->save($cacheKey, $xml, 3600);

        return $this->response
            ->setContentType('application/xml; charset=UTF-8')
            ->setBody($xml);
    }

    /**
     * 获取所有活跃的分类
     */
    private function getActiveCategories(): array
    {
        return $this->CategoryModel
            ->where('active', 1)
            ->orderBy('sequence', 'ASC')
            ->findAll();
    }

    /**
     * 获取所有已发布的文章
     */
    private function getPublishedArticles(): array
    {
        // 获取分类78的所有子分类（包括无限级）
        $cateids = $this->CategoryModel->getCategoryWithChildren(78);
        
        if (empty($cateids)) {
            return [];
        }
        
        return $this->ArticlesModel
            ->where('active', 1)
            ->where('deleted_at', null)
            ->whereIn('category_id', $cateids)
            ->select('id, category_id, slug, created_at, updated_at')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * 获取所有活跃的导航页面
     */
    private function getActiveNavigationPages(): array
    {
        return $this->NavigationModel
            ->where('active', 1)
            ->select('url, updated_at')
            ->orderBy('sequence', 'ASC')
            ->findAll();
    }

    /**
     * 格式化日期为标准的 sitemap lastmod 格式 (YYYY-MM-DD)
     */
    private function formatLastmod($date): string
    {
        if (empty($date)) {
            return date('Y-m-d');
        }

        // 如果是字符串，尝试解析
        if (is_string($date)) {
            $timestamp = strtotime($date);
            return $timestamp ? date('Y-m-d', $timestamp) : date('Y-m-d');
        }

        return date('Y-m-d');
    }

    /**
     * 将文本转换为URL友好的slug
     */
    private function slugify(string $text): string
    {
        // 如果已经是slug格式，直接返回
        if (preg_match('/^[a-z0-9\-]+$/', $text)) {
            return $text;
        }

        // 转换为小写
        $text = mb_strtolower($text, 'UTF-8');

        // 删除特殊字符，保留字母、数字和空格
        $text = preg_replace('/[^\w\s-]/u', '', $text);

        // 将空格替换为连字符
        $text = preg_replace('/[\s]+/', '-', $text);

        // 删除连续的连字符
        $text = preg_replace('/-+/', '-', $text);

        // 删除首尾的连字符
        $text = trim($text, '-');

        return $text;
    }
}

