<?php

namespace Framework\Router;

use Framework\Contracts\RouterInterface;
use Framework\Http\Request;
use Framework\Regex\RegexConstructor;
use Framework\Routing\RouteMatch;

class Router implements RouterInterface
{
    const CONFIG_KEY_PATH = "path";
    private $route = null;

    public function __construct($routes)
    {
        $this->route = $routes;
    }

    public function route(Request $request): RouteMatch
    {
        $uri = $request->getUri();
        $method = $request->getMethod();
        $routes = $this->route['routing']['routes'];
        $regex_constructor = new RegexConstructor();
        foreach ($routes as $paths) {
            if ($method !== $paths['method']) continue;

            $pattern = $regex_constructor->createRegex($paths);

            if (preg_match($pattern, $uri, $matches)) {
                $filter = function ($var) {
                    return !is_numeric($var);
                };
                $matches = array_filter($matches, $filter, ARRAY_FILTER_USE_KEY);

                return new RouteMatch(
                    $request->getMethod(),
                    $this->route['dispatcher']['controllerNamespace'].'\\'.$paths['controller'].$this->route['dispatcher']['controllerSuffix'],
                    $paths['action'],
                    $matches
                );
            }
        }
    }
}