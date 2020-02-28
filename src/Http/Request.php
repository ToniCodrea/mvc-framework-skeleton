<?php

namespace Framework\Http;

use Framework\Http\Message;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Framework\Http\URI;
use Psr\Http\Message\UriInterface;

class Request extends Message implements RequestInterface
{
    private $requestTarget;
    private $method;

    /**
     * @var UriInterface
     */
    private $uri;

    /**
     * Request constructor.
     * @param string $protocolVersion
     * @param string $method
     * @param UriInterface $uri
     * @param StreamInterface $body
     */
    public function __construct(
        string $protocolVersion,
        string $method,
        UriInterface $uri,
        StreamInterface $body
    )
    {
        parent::__construct($protocolVersion, $body);

        $this->method = $method;
        $this->uri = $uri;
        }

    /**
     * @return static
     */
    public static function createFromGlobals(): self
    {
        $protocolVersion = $_SERVER['SERVER_PROTOCOL'];
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = Uri::createFromGlobals();
        $body = new Stream(fopen('php://input', 'r'), 1024);
        $request = new self($protocolVersion,$method,$uri,$body);
        foreach($_SERVER as $variableName => $variableValue){
            if(strpos($variableName,'HTTP_') !== 0) {
                continue;
            }
            $request->addRawHeader($variableName,$variableValue);
        }

        return $request;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function addRawHeader($name, $value)
    {
        $name = ucwords(strtolower(strtr(substr($name, 5), '_', '-')), '-');
        $this->headers[$name] = explode(',', $value);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRequestTarget()
    {
        if ($this->requestTarget) {
            return $this->requestTarget;
        }
        if ($this->uri) {
            return $this->uri->__toString();
        }

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

    /**
     * @param string $name
     * @return mixed
     */
    public function getParameter(string $name) {
        return $_GET[$name];
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getCookie(string $name) {
        return $_COOKIE[$name];
    }

    /**
     * @param string $name
     * @param string $path
     */
    public function moveUploadedFile(string $name, string $path) {
        if (isset($_FILES[$name])) {
            if ($_FILES[$name]['error'] != UPLOAD_ERR_OK) {
                move_uploaded_file($_FILES[$name]['tmp_name'], $path);
            }
        }
    }
}
