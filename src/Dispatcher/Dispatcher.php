<?php

namespace Framework\Dispatcher;

use Framework\Contracts\DispatcherInterface;
use Framework\Controller\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routing\RouteMatch;

class Dispatcher implements DispatcherInterface {

    private $controllerNamespace;
    private $controllerSuffix;
    private $controllers;
    /**
     * @inheritDoc
     */

    public function  __construct($controllerNamespaces, $controllerSuffix)
    {
        $this->controllerNamespace = $controllerNamespaces;
        $this->controllerSuffix = $controllerSuffix;
    }

    /**
     * @param AbstractController $c
     */
    public function addController (AbstractController $c) {
        $this->controllers[] = $c;
    }

    private function getController(string $c) : AbstractController {
        foreach ($this->controllers as $controller) {
            if ($c === get_class($controller)) {
                return $controller;
            }
        }
    }

    public function dispatch(RouteMatch $routeMatch, Request $request) : Response
    {
        $controllerName = $this->controllerNamespace.'\\'.ucfirst($routeMatch->getControllerName()).$this->controllerSuffix;
        $controller = $this->getController($controllerName);
        $action = $routeMatch->getActionName();

        return $controller->$action($routeMatch, $request);
    }
}