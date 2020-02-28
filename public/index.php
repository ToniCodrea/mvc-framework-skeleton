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
$container = require $baseDir.'/config/services.php';

// create the application and handle the request
$application = Application::create($container);
$request = Request::createFromGlobals();
$response = $application->handle($request);
$response->send();