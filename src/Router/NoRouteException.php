<?php


namespace Framework\Router;


use Throwable;

class NoRouteException extends \Exception
{
    /**
     * @var string
     */
    private $route;

    public function __construct(string $route, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getRoute() : string
    {
        return $this->route;
    }
}