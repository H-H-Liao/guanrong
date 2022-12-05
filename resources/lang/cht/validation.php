<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute 必須被接受',
    'active_url' => ':attribute 不是有效的 URL',
    'after' => ':attribute 必須是 :date 之後的日期',
    'after_or_equal' => ':attribute 必須是晚於或等於 :date 的日期',
    'alpha' => ':attribute 只能包含字母',
    'alpha_dash' => ':attribute 只能包含、數字、破折號和下劃線',
    'alpha_num' => ':attribute 只能包含字母和數字',
    'array' => ':attribute 必須是一個數組',
    'before' => ':attribute 必須是 :date 之前的日期',
    'before_or_equal' => ':attribute 必須是早於或等於 :date 的日期',
    '之間' => [
        'numeric' => ':attribute 必須介於 :min 和 :max 之間',
        'file' => ':attribute 必須介於 :min 和 :max 千字節之間',
        'string' => ':attribute 必須介於 :min 和 :max 個字符之間',
        'array' => ':attribute 必須介於 :min 和 :max 項之間',
    ],
    'boolean' => ':attribute 字段必須為真或假',
    'confirmed' => ':attribute 確認不匹配',
    'date' => ':attribute 不是一個有效的日期',
    'date_equals' => ':attribute 必須是等於 :date 的日期',
    'date_format' => ':attribute 與格式 :format 不匹配',
    'different' => ':attribute 和 :other 必須不同',
    'digits' => ': attribute 必須是 :digits 數字',
    'digits_between' => ': attribute 必須介於 :min 和 :max 位數之間',
    'dimensions' => ':attribute 的圖像尺寸無效',
    'distinct' => ':attribute 字段有重複值',
    'email' => ':attribute 必須是有效的電子郵件地址',
    'ends_with' => ':attribute 必須以下列之一結尾: :values.',
    'exists' => '選中的 :attribute 無效',
    'file' => ':attribute 必須是一個文件',
    'filled' => ':attribute 字段必須有值',
    'gt' => [
        'numeric' => ':attribute 必須大於 :value.',
        'file' => ':attribute 必須大於 :value 千字節',
        'string' => ':attribute 必須大於 :value 個字符',
        'array' => ':attribute 必須有多個 :value 項',
    ],
    'gte' => [
        'numeric' => ':attribute 必須大於等於 :value.',
        'file' => ': attribute 必須大於或等於 :value 千字節',
        'string' => ':attribute 必須大於等於 :value 字符',
        'array' => ':attribute 必須有 :value 項或更多',
    ],
    'image' => ':attribute 必須是圖像',
    'in' => '選擇的:attribute 無效',
    'in_array' => ':other 中不存在 :attribute 字段',
    'integer' => ':attribute 必須是整數',
    'ip' => ':attribute 必須是有效的 IP 地址',
    'ipv4' => ':attribute 必須是有效的 IPv4 地址',
    'ipv6' => ':attribute 必須是有效的 IPv6 地址',
    'json' => ':attribute 必須是有效的 JSON 字符串',
    'lt' => [
        'numeric' => ':attribute 必須小於 :value.',
        'file' => ':attribute 必須小於 :value 千字節',
        'string' => ':attribute 必須小於 :value 個字符',
        'array' => ':attribute 必須有小於 :value 的項',
    ],
    'lte' => [
        'numeric' => ':attribute 必須小於或等於 :value.',
        'file' => ':attribute 必須小於或等於 :value 千字節',
        'string' => ':attribute 必須小於等於 :value 字符',
        'array' => ':attribute 不能有超過 :value 的項',
    ],
    '最大' => [
        'numeric' => ':attribute 不能大於 :max.',
        'file' => ':attribute 不能大於 :max 千字節',
        'string' => ':attribute 不能大於 :max 個字符',
        'array' => ':attribute 不能有超過 :max 個項目',
    ],
    'mimes' => ':attribute 必須是文件類型: :values.',
    'mimetypes' => ':attribute 必須是文件類型: :values.',
    '分鐘' => [
        'numeric' => ':attribute 必須至少為 :min.',
        'file' => ':attribute 必須至少為 :min 千字節',
        'string' => ':attribute 必須至少為 :min 個字符',
        'array' => ':attribute 必須至少有 :min 個項目',
    ],
    'not_in' => '選擇的 :attribute 無效',
    'not_regex' => ':attribute 格式無效',
    'numeric' => ':attribute 必須是數字',
    'password' => '密碼不正確',
    'present' => ':attribute 字段必須存在',
    'regex' => ':attribute 格式無效',
    'required' => ':attribute 字段是必需的',
    'required_if' => '當 :other 是 :value 時需要 :attribute 字段',
    'required_unless' => ':attribute 字段是必需的，除非 :other 在 :values 中',
    'required_with' => '當存在 :values 時需要 :attribute 字段',
    'required_with_all' => '當 :values 存在時 :attribute 字段是必需的',
    'required_without' => '當 :values 不存在時 :attribute 字段是必需的',
    'required_without_all' => '當不存在任何 :value 時，需要 :attribute 字段',
    'same' => ':attribute 和 :other 必須匹配',
    '大小' => [
        'numeric' => ':attribute 必須是 :size.',
        'file' => ':attribute 必須是 :size 千字節',
        'string' => ':attribute 必須是 :size 個字符',
        'array' => ':attribute 必須包含 :size 項',
    ],
    'starts_with' => ':attribute 必須以下列之一開頭: :values.',
    'string' => ':attribute 必須是字符串',
    'timezone' => ':attribute 必須是有效的時區',
    'unique' => ':attribute 已經被佔用',
    'uploaded' => ':attribute 上傳失敗',
    'url' => ':attribute 的有效地址，且必須為http://或https://',
    'uuid' => ':attribute 必須是有效的 UUID',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'allsections.*.title.*' => [
            'max' => '章節標題不得大於 :max 個字符',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
];
