<?php


return  [
    'base_url' => '/site/index',
    '404' => '/error_404',
    'route' => [
        '/lab1/query' => 'lab1/query',
        '/lab1' => 'lab1/index',
        '/lab2' => 'lab2/index',
        '/lab2/index' => 'lab2/index',
        '/lab2/query' => 'lab2/query',
        '/lab3' => 'lab3/index',
        '/lab3/test' => 'lab3/test',
        '/lab3/server' => 'lab3/server',

        '/error_404' => 'site/error404',
        '/lab4' => 'lab4/index',
        '/api/v1/lab4/get-all' => 'lab4/get-all',
        '/api/v1/lab4/create' => 'lab4/create',
        '/api/v1/lab4/update' => 'lab4/update',
        '/api/v1/lab4/delete' => 'lab4/delete',
    ],
];