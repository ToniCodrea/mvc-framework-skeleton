<?php

use Framework\Router\Router;

$configuration = [
    'dispatcher' => [
        'controllerNamespace' => 'Framework\Controller',
            'controllerSuffix' => 'Controller'
        ],
    'routing' => [
        'routes' => [
            'user_get' => [
                'method' => 'GET',
                'controller' => 'user',
                'action' => 'get',
                Router::CONFIG_KEY_PATH => '/user/{id}',
                'attributes' => [
                    'id' => '\d+'
                ]
            ],
            'user_get_all' => [
                'method' => 'GET',
                'controller' => 'user',
                'action' => 'getAll',
                Router::CONFIG_KEY_PATH => '/user',
                'attributes' => []
            ],
            'user_post' => [
                'method' => 'POST',
                'controller' => 'user',
                'action' => 'update',
                Router::CONFIG_KEY_PATH => '/user',
                'attributes' => []
            ],
            'user_delete' => [
                'method' => 'DELETE',
                'controller' => 'user',
                'action' => 'delete',
                Router::CONFIG_KEY_PATH => '/user',
                'attributes' => []
            ]
        ],
    ]
];

return $configuration;