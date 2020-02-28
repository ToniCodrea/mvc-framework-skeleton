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
    public function addController (AbstractController $c)
    {
        $this->controllers[get_class($c)] = $c;
    }

    /**
     * @param string $c
     * @return AbstractController
     */
    private function getController(string $c) : AbstractController
    {
        if ($this->controllers[$c]) {
            return $this->controllers[$c];
        }
    }

    /**
     * @param RouteMatch $routeMatch
     * @param Request $request
     * @return Response
     */
    public function dispatch(RouteMatch $routeMatch, Request $request) : Response
    {
        $controllerName = $this->controllerNamespace.'\\'.ucfirst($routeMatch->getControllerName()).$this->controllerSuffix;
        $controller = $this->getController($controllerName);
        $action = $routeMatch->getActionName();

        return $controller->$action($routeMatch, $request);
    }
}