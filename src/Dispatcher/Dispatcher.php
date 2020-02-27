<?php

namespace Framework\Dispatcher;

use Framework\Contracts\DispatcherInterface;
use Framework\Controller\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routing\RouteMatch;

class Dispatcher implements DispatcherInterface {

    private $controllerNamespaces;
    private $controllerSuffix;
    private array $controllers;
    /**
     * @inheritDoc
     */

    public function  __construct($controllerNamespaces, $controllerSuffix)
    {
        $this->controllerNamespaces = $controllerNamespaces;
        $this->controllerSuffix = $controllerSuffix;
    }

    /**
     * @param AbstractController $c
     */
    public function addController (AbstractController $c) {
        $this->controllers[] = $c;
    }

    public function dispatch(RouteMatch $routeMatch, Request $request): Response
    {

    }
}