<?php
return [
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'user',
        ],
    ],
    'manager' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'user',
            'user_manage',
            'news_manage',
        ],
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
    ],
    'user_manage' => [
        'type' => 2,
    ],
    'news_manage' => [
        'type' => 2,
    ],
];
