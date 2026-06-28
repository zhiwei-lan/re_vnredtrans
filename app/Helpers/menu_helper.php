<?php

use App\Models\MenuModel;
use App\Models\NavigationModel;

//菜单权限过滤
if (! function_exists('menu')) {
    function menu(): array
    {
        $user = auth()->user();
        if (! $user) return [];

        $menus = (new MenuModel())->where('active', 1)->orderBy('sequence', 'ASC')->findAll();
       
        $menus = array_filter($menus, function($menu) use ($user) {
            return empty($menu->permission) || $user->can($menu->permission);
        });
        return buildTree($menus);
    }
}
//树形结构
if (! function_exists('buildTree')) {
    function buildTree(array $items, int $parentId = 0): array
    {
        $branch = [];
        $locale = service('lang')->getLocale();
        foreach ($items as $item) {
            if(!empty($item['url'])){
                $item['url'] = '/' .$locale . '/' . ltrim($item['url'], '/');
            }
            
            if ((int)$item['parent_id'] === $parentId) {
                $item['children'] = buildTree($items, (int)$item['id']);
                $branch[] = $item;
            }
        }
        return $branch;
    }
}
//前台导航菜单
if (! function_exists('frontendMenu')) {
    function frontendMenu(string $currentUri): array
    {
        $locale = service('lang')->getLocale();
        $cacheKey = 'frontend_menu_tree_' . $locale;

        $cache = cache();

        $menus = $cache->get($cacheKey);

        if ($menus === null) {

            $menus = buildTree(
                (new NavigationModel())
                    ->select([
                        'navigation.url',
                        'navigation.title',
                        'navigation.id',
                        'navigation.parent_id',
                        'navigation.sequence',
                        'navigation.description',
                        'navigation.subject',
                        'navigation.open_new',
                        'languages.title AS lang_title',
                        'languages.subject AS lang_subject',
                        'languages.description AS lang_description',
                    ])
                    ->join(
                        'languages',
                        "languages.trans_id = navigation.id 
                        AND languages.trans_type = 'navigation' 
                        AND languages.lang = '{$locale}'",
                        'left'
                    )
                    ->where('navigation.active', 1)
                    ->orderBy('navigation.sequence', 'ASC')
                    ->findAll()
            );
            // 缓存 1 小时
            $cache->save($cacheKey, $menus, 3600);
        }

        return markActiveMenus($menus, $currentUri);
    }
}
//前台标记当前菜单状态
if (! function_exists('markActiveMenus')) {
    function markActiveMenus(array $menus, string $currentUri): array
    {
        $currentUri = trim($currentUri, '/');

        foreach ($menus as &$menu) {
            $menuUrl = trim($menu['url'] ?? '', '/');

            // 首页兜底
            if ($currentUri === '' && ($menu['is_home'] ?? false)) {
                $menu['is_current'] = true;
            }
            // 精确命中
            elseif ($menuUrl !== '' && $menuUrl === $currentUri) {
                $menu['is_current'] = true;
            }
            // 父级兜底命中
            elseif (
                $menuUrl !== ''
                && str_starts_with($currentUri, $menuUrl . '/')
            ) {
                $menu['is_current'] = true;
            }
            else {
                $menu['is_current'] = false;
            }

            $menu['is_active']  = $menu['is_current'];
            $menu['has_active'] = false;

            if (!empty($menu['children'])) {
                $menu['children'] = markActiveMenus($menu['children'], $currentUri);

                foreach ($menu['children'] as $child) {
                    if ($child['is_active'] || $child['has_active']) {
                        $menu['has_active'] = true;
                        $menu['is_active']  = true;
                        break;
                    }
                }
            }
        }

        return $menus;
    }
}

//获取当前页面菜单
if (! function_exists('getCurrentMenu')) {
    function getCurrentMenu(array $menus)
    {
        foreach ($menus as $menu) {
            if ($menu['is_current']) return $menu;
            if (!empty($menu['children'])) {
                $found = getCurrentMenu($menu['children']);
                if ($found) return $found;
            }
        }
        return null;
    }
}
//构建面包屑导航结构
if (! function_exists('buildBreadcrumbFromMenus')) {
    function buildBreadcrumbFromMenus(array $menus, array $parents = []): ?array
    {
        foreach ($menus as $menu) {

            $currentPath = array_merge($parents, [[
                'title' => $menu['title'],
                'lang_title' => $menu['lang_title'],
                'url'   => $menu['url'] ?? '',
            ]]);

            // 命中当前页面
            if (!empty($menu['is_current'])) {
                return $currentPath;
            }

            // 向下递归
            if (!empty($menu['children'])) {
                $found = buildBreadcrumbFromMenus($menu['children'], $currentPath);
                if ($found !== null) {
                    return $found;
                }
            }
        }

        return null;
    }
}
//标记激活分类
if (! function_exists('markActiveCategory')) {
    function markActiveCategory(array $categories, int $activeId = 0): array
    {
        foreach ($categories as &$category) {
            $category['is_active'] = ($activeId && $category['id'] === $activeId);
        }
        unset($category);

        return $categories;
    }
}