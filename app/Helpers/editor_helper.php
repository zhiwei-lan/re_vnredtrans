<?php
if (! function_exists('merge_media_ids')) {
     function merge_media_ids(...$sources): array
    {
        $ids = [];

        foreach ($sources as $source) {
            if (empty($source)) {
                continue;
            }

            $ids = array_merge($ids, (array) $source);
        }

        return array_values(array_unique(array_map('intval', $ids)));
    }
}
    
if (! function_exists('normalize_ids')) {
    /**
     * 将 ids 统一转为数组
     *
     * @param mixed $value
     * @return int[]
     */
    function normalize_ids($value): array
    {
        if (empty($value)) {
            return [];
        }

        // 已经是数组
        if (is_array($value)) {
            return array_values(array_map('intval', $value));
        }

        // JSON 字符串
        if (is_string($value) && str_starts_with(trim($value), '[')) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return array_values(array_map('intval', $decoded));
            }
        }

        // 逗号分隔字符串：1,2,3
        if (is_string($value)) {
            return array_values(
                array_map('intval', array_filter(explode(',', $value)))
            );
        }

        return [];
    }
}

if (! function_exists('extract_editor_image_ids')) {
   
    /**
     * 从 Quill / 编辑器 Delta 中提取图片 ID
     *
     * @param array|string $delta 编辑器内容（array 或 json string）
     * @return int[]
     */
    function extract_editor_image_ids($delta): array
    {
        if (is_string($delta)) {
            $delta = json_decode($delta, true);
        }

        if (! is_array($delta) || empty($delta['ops'])) {
            return [];
        }

        $ids = [];

        foreach ($delta['ops'] as $op) {
            if (! isset($op['insert']['image'])) {
                continue;
            }

            $url = $op['insert']['image'];

            // 🚫 排除外部链接（只允许相对路径）
            if (! str_starts_with($url, '/')) {
                continue;
            }

            $query = parse_url($url, PHP_URL_QUERY);
            if (! $query) {
                continue;
            }

            parse_str($query, $params);

            if (isset($params['id']) && is_numeric($params['id'])) {
                $ids[] = (int) $params['id'];
            }
        }

        return array_values(array_unique($ids));
    }
}
