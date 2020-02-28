<?php

namespace Framework\Exceptions;

use Throwable;

class NoMethodException extends \Exception
{
    protected $message;
    protected $code;
    protected $file;
    protected $line;
    /**
     * @var string
     */
    private $methodName;

    /**
     * NoControllerException constructor.
     * @param string $route
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $methodName, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->methodName = $methodName;
    }

    /**
     * @return mixed
     */
    public function getName() : string
    {
        return $this->methodName;
    }
}