<?php

use Framework\Renderer\Renderer;
use Framework\Router\Router;

$configuration = [
    'renderer' => [
        Renderer::CONFIG_KEY_BASE_VIEW_PATH => dirname(__DIR__) . '/views/'
    ],
    'dispatcher' => [
        'controllerNamespace' => 'Framework\Controller',
            'controllerSuffix' => 'Controller'
        ],
    'routing' => [
        'routes' => [
            'user_get' => [
                Router::CONFIG_KEY_METHOD => 'GET',
                Router::CONFIG_KEY_CONTROLLER => 'user',
                Router::CONFIG_KEY_ACTION => 'get',
                Router::CONFIG_KEY_PATH => '/user/{id}',
                Router::CONFIG_KEY_ATTRIBUTES => [
                    'id' => '\d+'
                ]
            ],
            'user_get_all' => [
                Router::CONFIG_KEY_METHOD => 'GET',
                Router::CONFIG_KEY_CONTROLLER => 'user',
                Router::CONFIG_KEY_ACTION => 'getAll',
                Router::CONFIG_KEY_PATH => '/user',
                Router::CONFIG_KEY_ATTRIBUTES => []
            ],
            'user_post' => [
                Router::CONFIG_KEY_METHOD => 'POST',
                Router::CONFIG_KEY_CONTROLLER => 'user',
                Router::CONFIG_KEY_ACTION => 'update',
                Router::CONFIG_KEY_PATH => '/user/{id}/role/{name}/\?p={priority}',
                Router::CONFIG_KEY_ATTRIBUTES => [
                    'id' => '\d+',
                    'name' => '\w+',
                    'priority' => '\d+'
                ]
            ],
            'user_delete' => [
                Router::CONFIG_KEY_METHOD => 'DELETE',
                Router::CONFIG_KEY_CONTROLLER => 'user',
                Router::CONFIG_KEY_ACTION => 'delete',
                Router::CONFIG_KEY_PATH => '/user/{id}',
                Router::CONFIG_KEY_ATTRIBUTES => [
                    'id' => '\d+'
                ]
            ]
        ],
    ]
];

return $configuration;