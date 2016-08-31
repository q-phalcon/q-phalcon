<?php
/*
 |--------------------------------------------------------------------------
 | 本地开发环境的配置文件，该文件中的配置项会覆盖config目录下对应的配置
 |--------------------------------------------------------------------------
 |
 | 正式环境一定要删除该文件哦！
 |
 */
return [
    "app" => [
        'debug' => true,
        'log_mode' => 0,
        'request_start_log' => true,
        'request_log_post' => true,
    ],

    "database" => [
        'default' => [
            "driver"    => "mysql",
            "host"      => "127.0.0.1",
            "username"  => "root",
            "password"  => "",
            "dbname"    => "qp_mysql",
            "charset"   => "utf8",
        ],

        "redis" => [
            'redis' => [
                'host' => "127.0.0.1",
                'port' => 6379,
                'auth' => '',
                'database' => 0,
                'prefix' => ''
            ],
        ],
    ],

    "session" => [
        'open' => false
    ]
];