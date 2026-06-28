<?php

namespace App\Services\Frontend;

use App\Models\ArticlesModel;
use App\Models\CategoryModel;
use CodeIgniter\Database\BaseBuilder;

/**
 * Sitemap 服务类
 * 处理网站地图的生成和管理
 */
class SitemapService
{
    protected ArticlesModel $ArticlesModel;
    protected CategoryModel $CategoryModel;

    public function __construct()
    {
        $this->ArticlesModel = new ArticlesModel();
        $this->CategoryModel = new CategoryModel();
    }

    /**
     * 生成完整的 Sitemap URL 列表
     */
    public function generateSitemapUrls(): array
    {
        $urls = [];

        // 首页
        $urls[] = $this->createUrlEntry(
            loc: base_url('/'),
            changefreq: 'weekly',
            priority: '1.0'
        );

        // 分类页面
        $urls = array_merge($urls, $this->getCategories());

        // 文章页面
        $urls = array_merge($urls, $this->getArticles());

        return $urls;
    }

    /**
     * 获取所有分类的 URL 条目
     */
    public function getCategories(): array
    {
        $categories = $this->CategoryModel
            ->where('active', 1)
            ->orderBy('sequence', 'ASC')
            ->findAll();

        $urls = [];
        foreach ($categories as $category) {
            $urls[] = $this->createUrlEntry(
                loc: base_url("article/{$category['id']}/{$this->slugify($category['title'])}"),
                lastmod: $category['updated_at'] ?? date('Y-m-d'),
                changefreq: 'weekly',
                priority: '0.8'
            );
        }

        return $urls;
    }

    /**
     * 获取所有文章的 URL 条目
     */
    public function getArticles(): array
    {
        $articles = $this->ArticlesModel
            ->where('active', 1)
            ->where('deleted_at', null)
            ->select('id, category_id, slug, created_at, updated_at')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $urls = [];
        foreach ($articles as $article) {
            $urls[] = $this->createUrlEntry(
                loc: base_url("article/{$article['category_id']}/detail/{$article['slug']}/{$article['id']}"),
                lastmod: $article['updated_at'] ?? $article['created_at'] ?? date('Y-m-d'),
                changefreq: 'weekly',
                priority: '0.6'
            );
        }

        return $urls;
    }

    /**
     * 获取特定分类下的文章
     */
    public function getArticlesByCategory(int $categoryId): array
    {
        $articles = $this->ArticlesModel
            ->where('category_id', $categoryId)
            ->where('active', 1)
            ->where('deleted_at', null)
            ->select('id, category_id, slug, created_at, updated_at')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $urls = [];
        foreach ($articles as $article) {
            $urls[] = $this->createUrlEntry(
                loc: base_url("article/{$article['category_id']}/detail/{$article['slug']}/{$article['id']}"),
                lastmod: $article['updated_at'] ?? $article['created_at'] ?? date('Y-m-d'),
                changefreq: 'weekly',
                priority: '0.6'
            );
        }

        return $urls;
    }

    /**
     * 创建 URL 条目
     */
    private function createUrlEntry(
        string $loc,
        ?string $lastmod = null,
        ?string $changefreq = null,
        ?string $priority = null
    ): array {
        return [
            'loc'        => $loc,
            'lastmod'    => $lastmod ?? date('Y-m-d'),
            'changefreq' => $changefreq ?? 'weekly',
            'priority'   => $priority ?? '0.5',
        ];
    }

    /**
     * 将文本转换为 URL 友好的 slug
     */
    public function slugify(string $text): string
    {
        // 如果已经是 slug 格式，直接返回
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

    /**
     * 获取统计信息
     */
    public function getStatistics(): array
    {
        $totalCategories = $this->CategoryModel
            ->where('active', 1)
            ->countAllResults();

        $totalArticles = $this->ArticlesModel
            ->where('active', 1)
            ->where('deleted_at', null)
            ->countAllResults();

        return [
            'total_urls'      => 1 + $totalCategories + $totalArticles, // 首页 + 分类 + 文章
            'categories'      => $totalCategories,
            'articles'        => $totalArticles,
            'generated_at'    => date('Y-m-d H:i:s'),
        ];
    }

    /**
     * 验证 URL 格式
     */
    public function validateUrl(string $url): bool
    {
        // 检查 URL 是否有效
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * 生成 Sitemap 索引（用于大型网站）
     * 
     * 当网站有超过 50,000 条 URL 时使用
     */
    public function generateSitemapIndex(): array
    {
        $sitemaps = [
            [
                'loc'     => base_url('sitemap-main.xml'),
                'lastmod' => date('Y-m-d'),
            ],
            [
                'loc'     => base_url('sitemap-categories.xml'),
                'lastmod' => date('Y-m-d'),
            ],
            [
                'loc'     => base_url('sitemap-articles.xml'),
                'lastmod' => date('Y-m-d'),
            ],
        ];

        return $sitemaps;
    }
}
