<?php

use app\template\Template;

$db_ms = require_once 'db_ms.php';
$db = require_once 'db.php';
$db_pg = require_once 'db_postgres.php';
$route = require_once 'route.php';

return [
    'is_develop' => true,
    'urlManager' => $route,
    'db_pdo' => $db,
    'ms_db' => $db_ms,
    'db_pg' => $db_pg,
    'base_path' => sprintf('..%s%s%s',DIRECTORY_SEPARATOR,__DIR__, DIRECTORY_SEPARATOR),
    'path_to_save_files' => '..'.DIRECTORY_SEPARATOR.__DIR__ . DIRECTORY_SEPARATOR . 'files_save' . DIRECTORY_SEPARATOR,
    'dist' => [
        'css' => [
            '../css/main.css',
        ],
        'js' => [
            '../js/main.js',
//            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js',
//            'https://code.jquery.com/jquery-3.2.1.slim.min.js',
//            'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js',
        ],
//        'fonts' => [
//            '../fonts/bootstrap-icons.woff'
//        ],
    ],
    'view' => [
        'render_class' => Template::class,
        Template::class => [ // default php
            'path_view' => sprintf('%s%sresources%sview%sphp%s',
                __DIR__,
                DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR,
                DIRECTORY_SEPARATOR,
                DIRECTORY_SEPARATOR,
                DIRECTORY_SEPARATOR
            ),
            'layout' => 'main',
        ],
    ],

];