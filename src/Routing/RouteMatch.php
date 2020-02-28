<?php

namespace Framework\Routing;

class RouteMatch
{
    private $method = null;
    private $controller = null;
    private $action = null;
    private $reqAttributes = null;

    /**
     * RouteMatch constructor.
     * @param $method
     * @param $controller
     * @param $action
     * @param $reqAttributes
     */
    public function __construct($method, $controller, $action, $reqAttributes)
    {
        $this->method = $method;
        $this->controller = $controller;
        $this->action = $action;
        $this->reqAttributes = $reqAttributes;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getRequestAttributes(): array
    {
        return $this->reqAttributes;
    }
}
