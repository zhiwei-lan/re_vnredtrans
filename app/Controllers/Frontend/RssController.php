<?php

namespace App\Controllers\Frontend;

use CodeIgniter\Controller;
use App\Models\ArticlesModel;
use App\Models\CategoryModel;

/**
 * RSS Feed Controller
 * 生成RSS订阅源供用户订阅
 */
class RssController extends Controller
{
    protected ArticlesModel $ArticlesModel;
    protected CategoryModel $CategoryModel;

    public function __construct()
    {
        $this->ArticlesModel = new ArticlesModel();
        $this->CategoryModel = new CategoryModel();
    }

    /**
     * 生成 RSS Feed
     * 
     * 包含：
     * - 网站基本信息
     * - 最新发布的文章（可配置数量）
     * - 文章的完整描述
     */
    public function index()
    {
        $cache = cache();
        $cacheKey = 'rss_feed';
        $locale = config('App')->defaultLocale;
        
        // 检查缓存（1小时）
        $rss = $cache->get($cacheKey);
        if ($rss !== null) {
            return $this->response
                ->setContentType('application/rss+xml; charset=UTF-8')
                ->setBody($rss);
        }

        // --------------------------
        // 获取网站配置
        // --------------------------
        $siteTitle = 'Nature POS';
        $siteDescription = '专业的自然美和健康生活知识分享平台';
        $siteUrl = base_url('/');
        $siteLanguage = $locale;

        // --------------------------
        // 获取文章数据
        // --------------------------
        $articles = $this->getLatestArticles(50); // 获取最新50篇文章

        // --------------------------
        // 生成 RSS XML
        // --------------------------
        $rss = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $rss .= '<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">' . PHP_EOL;
        $rss .= '    <channel>' . PHP_EOL;
        $rss .= '        <title>' . htmlspecialchars($siteTitle, ENT_XML1, 'UTF-8') . '</title>' . PHP_EOL;
        $rss .= '        <link>' . htmlspecialchars($siteUrl, ENT_XML1, 'UTF-8') . '</link>' . PHP_EOL;
        $rss .= '        <description>' . htmlspecialchars($siteDescription, ENT_XML1, 'UTF-8') . '</description>' . PHP_EOL;
        $rss .= '        <language>' . htmlspecialchars($siteLanguage, ENT_XML1, 'UTF-8') . '</language>' . PHP_EOL;
        $rss .= '        <lastBuildDate>' . date('r') . '</lastBuildDate>' . PHP_EOL;
        $rss .= '        <generator>CodeIgniter 4 RSS Generator</generator>' . PHP_EOL;

        // 添加文章项
        foreach ($articles as $article) {
            $articleUrl = base_url("{$locale}/article/62/detail/{$article['slug']}/{$article['id']}");
            $pubDate = $this->formatRssDate($article['created_at']);
            $description = $this->stripHtml($article['description'] ?? '');
            
            $rss .= '        <item>' . PHP_EOL;
            $rss .= '            <title>' . htmlspecialchars($article['title'], ENT_XML1, 'UTF-8') . '</title>' . PHP_EOL;
            $rss .= '            <link>' . htmlspecialchars($articleUrl, ENT_XML1, 'UTF-8') . '</link>' . PHP_EOL;
            $rss .= '            <guid isPermaLink="true">' . htmlspecialchars($articleUrl, ENT_XML1, 'UTF-8') . '</guid>' . PHP_EOL;
            $rss .= '            <pubDate>' . htmlspecialchars($pubDate, ENT_XML1, 'UTF-8') . '</pubDate>' . PHP_EOL;
            $rss .= '            <description>' . htmlspecialchars($description, ENT_XML1, 'UTF-8') . '</description>' . PHP_EOL;
            
            // 添加完整内容
            if (!empty($article['content'])) {
                $content = $this->stripHtml($article['content']);
                $rss .= '            <content:encoded><![CDATA[' . $article['content'] . ']]></content:encoded>' . PHP_EOL;
            }
            
            $rss .= '        </item>' . PHP_EOL;
        }

        $rss .= '    </channel>' . PHP_EOL;
        $rss .= '</rss>';

        // 写入缓存
        //$cache->save($cacheKey, $rss, 3600);

        return $this->response
            ->setContentType('application/rss+xml; charset=UTF-8')
            ->setBody($rss);
    }

    /**
     * 获取最新的已发布文章
     */
    private function getLatestArticles(int $limit = 50): array
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
            ->select('id, category_id, title, slug, description, content, created_at, updated_at')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * 格式化日期为 RSS 标准格式 (RFC 2822)
     * 例如：Mon, 03 Feb 2026 12:34:56 +0000
     */
    private function formatRssDate($date): string
    {
        if (empty($date)) {
            return date('r');
        }

        if (is_string($date)) {
            $timestamp = strtotime($date);
            return $timestamp ? date('r', $timestamp) : date('r');
        }

        return date('r');
    }

    /**
     * 去除HTML标签
     */
    private function stripHtml(string $text): string
    {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }
}
