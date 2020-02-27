<?php

namespace Framework\Http;

use Framework\Http\Message;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request extends Message implements RequestInterface
{
    private $requestTarget;
    private $method;

    /**
     * @var UriInterface
     */
    private $uri;

    public function __construct()
    {

    }

    /*public static function createFromGlobals(): self
    {
        // TODO:
        // look in $_GET, $_POST, $_SERVER, $_FILES, $_COOKIES and extract data into this objects properties for
        // easy access
        $Request = new Request();
        return $Request;
    } */

    /**
     * @inheritDoc
     */
    public function getRequestTarget()
    {
        if ($this->requestTarget) return $this->requestTarget;
        if ($this->uri) return $this->uri->__toString();
        return "/";
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget)
    {
        $request = clone $this;
        $request->requestTarget = "$requestTarget";
        return $request;
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method)
    {
        $request = clone $this;
        $request->method = $method;
        return $request;
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        $request = clone $this;
        $request->uri = $uri;
        return $request;
    }
}
