<?php

namespace Framework\Http;

use Framework\Http\Message;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request extends Message
{
    private $get = null;
    private $post = null;
    private $server = null;
    private $file = null;
    private $cookie = null;

    public static function createFromGlobals(): self
    {
        // TODO:
        // look in $_GET, $_POST, $_SERVER, $_FILES, $_COOKIES and extract data into this objects properties for
        // easy access
        $Request = new Request();
        $Request = $Request->withProtocolVersion();
        return $Request;
    }

    public function getParameter(string $name)
    {
        //TODO
    }

    public function getCookie(string $name)
    {
        //TODO
    }

    public function moveUploadedFile(string $path)
    {
        //TODO
    }

    // TODO: implement methods declared by RequestInterface

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->server[""];
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $_SERVER["HTTP_HOST"];
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        // TODO: Implement hasHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        // TODO: Implement getBody() method.
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }

    /**
     * @inheritDoc
     */
    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return ;
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method)
    {
        // TODO: Implement withMethod() method.
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return '/user/1';
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        // TODO: Implement withUri() method.
    }

    public function getPath(): string
    {
        // TODO: Implement function getPath().
    }
}
