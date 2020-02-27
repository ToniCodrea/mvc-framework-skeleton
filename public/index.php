<?php

// obtain the base directory for the web application a.k.a. document root
$baseDir = dirname(__DIR__);

// setup auto-loading
require $baseDir.'/vendor/autoload.php';

use Framework\Application;
use Framework\Http\Request;
use Framework\Router\Router;

// obtain the DI container
/*$container = require $baseDir.'/config/services.php';



// create the application and handle the request
$application = Application::create($container);
$request = Request::createFromGlobals();
$response = $application->handle($request);
$response->send();*/

/*$x = require $baseDir.'/config/routes.php';

$obj = new Router($x);
$req = new Request();
print_r($obj->route($req)); */

print_r($_SERVER);