<?php

declare(strict_types = 1);

namespace Framework\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class Message implements MessageInterface
{
    private $protocolVersion;
    private $headers;
    private $body;

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version) : self
    {
        $message = clone $this;
        $message->protocolVersion = $version;

        return $message;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name) : bool
    {
        return $this->headers[$name];
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name) : array
    {
        $arr = array();
        $arr = preg_split('/,/', $this->headers[$name]);
        return $arr;
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name) : string
    {
        return $this->headers[$name];
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
    public function withAddedHeader($name, $value) : self
    {
        $message = clone $this;
        $message->protocolVersion = $version;

        return $message;
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
}