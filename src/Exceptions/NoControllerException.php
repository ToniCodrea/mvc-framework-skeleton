<?php

namespace Framework\Exceptions;

use Throwable;

class NoControllerException extends \Exception
{
    protected $message;
    protected $code;
    protected $file;
    protected $line;
    /**
     * @var string
     */
    private $controllerName;

    /**
     * NoControllerException constructor.
     * @param string $route
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $controllerName, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->controllerName = $controllerName;
    }

    /**
     * @return mixed
     */
    public function getName() : string
    {
        return $this->controllerName;
    }
}