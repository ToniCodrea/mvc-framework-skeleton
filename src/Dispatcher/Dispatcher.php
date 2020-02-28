<?php

namespace Framework\Dispatcher;

use Framework\Contracts\DispatcherInterface;
use Framework\Controller\AbstractController;
use Framework\Exceptions\NoControllerException;
use Framework\Exceptions\NoMethodException;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routing\RouteMatch;
use Framework\Exceptions;

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
     * @throws NoControllerException
     */
    private function getController(string $c) : AbstractController
    {
        if ($this->controllers[$c]) {
            return $this->controllers[$c];
        }
        throw new NoControllerException($c);
    }

    /**
     * @param RouteMatch $routeMatch
     * @param Request $request
     * @return Response
     * @throws NoControllerException
     * @throws Exceptions\NoMethodException
     */
    public function dispatch(RouteMatch $routeMatch, Request $request) : Response
    {
        $controllerName = $this->controllerNamespace.'\\'.ucfirst($routeMatch->getControllerName()).$this->controllerSuffix;
        $controller = $this->getController($controllerName);
        $action = $routeMatch->getActionName();
        if (!(method_exists($controller, $action)) {
            throw new NoMethodException($action);
        }
        return $controller->$action($routeMatch, $request);
    }
}