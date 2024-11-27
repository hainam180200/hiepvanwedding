<?php

use  Illuminate\Contracts\Container\Container;

// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => '- Trang chính',
            'root' => true,
            'permission' => '',
            'icon' => '',
            'route' => 'admin.index',
            'page' => '',
            'new-tab' => false,
        ]
        ,[
            'title' => '- Danh mục',
            'root' => true,
            'permission' => '',
            'icon' => '',
            'route' => 'admin.index',
            'page' => '',
            'new-tab' => false,
        ],
    ]
];
