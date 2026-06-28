<?php

if (! function_exists('arrayToBool')) {
        /**
     * 将数组中的值统一转成 true/false
     *
     * @param array $data 原始数组
     * @param array|null $keys 要转换的键名数组，null 表示全部键都转换
     * @return array 转换后的数组
     */
    function arrayToBool(array $data, ?array $keys = null): array
    {
        $result = [];

        foreach ($data as $k => $v) {
            if ($keys === null || in_array($k, $keys)) {
                $result[$k] = !empty($v); // 非空即 true，空即 false
            } else {
                $result[$k] = $v; // 不在 keys 列表的保持原值
            }
        }

        return $result;
    }
}

