<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// Validation language settings (유효성 검사 언어 설정)
return [
    // Core Messages (핵심 메시지)
    'noRuleSets'      => '유효성 검사 설정에 규칙 세트가 지정되지 않았습니다.',
    'ruleNotFound'    => '"{0}"은(는) 유효한 규칙이 아닙니다.',
    'groupNotFound'   => '"{0}"은(는) 유효성 검사 규칙 그룹이 아닙니다.',
    'groupNotArray'   => '"{0}" 규칙 그룹은 배열이어야 합니다.',
    'invalidTemplate' => '"{0}"은(는) 유효한 유효성 검사 템플릿이 아닙니다.',

    // Rule Messages (규칙 메시지)
    'alpha'                 => '{field} 는 알파벳 문자만 포함될 수 있습니다.',
    'alpha_dash'            => '{field} 는 영숫자, 밑줄, 대시 문자만 포함될 수 있습니다.',
    'alpha_numeric'         => '{field} 는 영숫자 문자만 포함될 수 있습니다.',
    'alpha_numeric_punct'   => '{field} 는 영숫자, 공백, 그리고 ~ ! # $ % & * - _ + = | : . 문자만 포함될 수 있습니다.',
    'alpha_numeric_space'   => '{field} 는 영숫자와 공백 문자만 포함될 수 있습니다.',
    'alpha_space'           => '{field} 는 알파벳 문자와 공백만 포함될 수 있습니다.',
    'decimal'               => '{field} 는 소수(decimal)를 포함해야 합니다.',
    'differs'               => '{field} 는 {param} 와 달라야 합니다.',
    'equals'                => '{field} 는 정확히 {param}과(와) 같아야 합니다.',
    'exact_length'          => '{field} 는 정확히 {param}자 길이여야 합니다.',
    'field_exists'          => '{field} 가 존재해야 합니다.',
    'greater_than'          => '{field} 는 {param}보다 큰 숫자를 포함해야 합니다.',
    'greater_than_equal_to' => '{field} 는 {param}보다 크거나 같은 숫자를 포함해야 합니다.',
    'hex'                   => '{field} 는 16진수 문자만 포함될 수 있습니다.',
    'in_list'               => '{field} 는 다음 중 하나여야 합니다: {param}.',
    'integer'               => '{field} 는 정수(integer)를 포함해야 합니다.',
    'is_natural'            => '{field} 는 숫자만 포함되어야 합니다.',
    'is_natural_no_zero'    => '{field} 는 숫자만 포함되어야 하며, 0보다 커야 합니다.',
    'is_not_unique'         => '{field} 는 데이터베이스에 이미 존재하는 값을 포함해야 합니다.',
    'is_unique'             => '{field} 는 이미존재한 {field} 입니다.',
    'less_than'             => '{field} 는 {param}보다 작은 숫자를 포함해야 합니다.',
    'less_than_equal_to'    => '{field} 는 {param}보다 작거나 같은 숫자를 포함해야 합니다.',
    'matches'               => '{field} 가 {param} 와 일치하지 않습니다.',
    'max_length'            => '{field} 는 {param}자를 초과할 수 없습니다.',
    'min_length'            => '{field} 는 최소 {param}자 이상이어야 합니다.',
    'not_equals'            => '{field} 는 {param}일 수 없습니다.',
    'not_in_list'           => '{field} 는 다음 중 하나가 아니어야 합니다: {param}.',
    'numeric'               => '{field} 는 숫자만 포함해야 합니다.',
    'regex_match'           => '{field} 의 형식이 올바르지 않습니다.',
    'required'              => '{field} 는 필수입니다.',
    'required_with'         => '{field} 는 {param}이(가) 있을 때 필수입니다.',
    'required_without'      => '{field} 는 {param}이(가) 없을 때 필수입니다.',
    'string'                => '{field} 는 유효한 문자열이어야 합니다.',
    'timezone'              => '{field} 는 유효한 시간대(timezone)여야 합니다.',
    'valid_base64'          => '{field} 는 유효한 base64 문자열이어야 합니다.',
    'valid_email'           => '{field} 는 유효한 이메일 주소를 포함해야 합니다.',
    'valid_emails'          => '{field} 는 모든 유효한 이메일 주소를 포함해야 합니다.',
    'valid_ip'              => '{field} 는 유효한 IP 주소를 포함해야 합니다.',
    'valid_url'             => '{field} 는 유효한 URL을 포함해야 합니다.',
    'valid_url_strict'      => '{field} 는 유효한 URL을 포함해야 합니다.',
    'valid_date'            => '{field} 는 유효한 날짜를 포함해야 합니다.',
    'valid_json'            => '{field} 는 유효한 JSON을 포함해야 합니다.',

    // Credit Cards (신용 카드)
    'valid_cc_num' => '{field}은(는) 유효한 신용카드 번호가 아닌 것 같습니다.',

    // Files (파일)
    'uploaded' => '{field}은(는) 유효한 업로드 파일이 아닙니다.',
    'max_size' => '{field} 파일의 크기가 너무 큽니다.',
    'is_image' => '{field}은(는) 유효한 업로드된 이미지 파일이 아닙니다.',
    'mime_in'  => '{field}은(는) 유효한 MIME 유형이 아닙니다.',
    'ext_in'   => '{field}은(는) 유효한 파일 확장자가 아닙니다.',
    'max_dims' => '{field}은(는) 이미지가 아니거나 너비 또는 높이가 너무 큽니다.',
    'min_dims' => '{field}은(는) 이미지가 아니거나 너비 또는 높이가 충분하지 않습니다.',
];