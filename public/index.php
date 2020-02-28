<?php

// obtain the base directory for the web application a.k.a. document root
$baseDir = dirname(__DIR__);

// setup auto-loading
require $baseDir.'/vendor/autoload.php';

use Framework\Application;
use Framework\Controller\UserController;
use Framework\Dispatcher\Dispatcher;
use Framework\Http\Request;
use Framework\Router\Router;


// obtain the DI container
//$container = require $baseDir.'/config/services.php';

// create the application and handle the request
//$application = Application::create($container);

$config = require $baseDir . '/config/config.php';
$router = new Router($config);
$request = Request::createFromGlobals();
try {
    $routeMatch = $router->route($request);
    $render = new \Framework\Renderer\Renderer($config['renderer'][\Framework\Renderer\Renderer::CONFIG_KEY_BASE_VIEW_PATH]);
    $dispatch = new Dispatcher($config['dispatcher']['controllerNamespace'], $config['dispatcher']['controllerSuffix']);
    $dispatch->addController(new UserController($render, 1) );
    $response = $dispatch->dispatch($routeMatch, $request);
    $response->send();
} catch (\Framework\Router\NoRouteException $e) {
    echo "Invalid route: " . $e->getRoute();
}