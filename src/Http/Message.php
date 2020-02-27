<?php

declare(strict_types = 1);

namespace Framework\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class Message implements MessageInterface
{
    private string $protocolVersion;
    private array $headers;
    private StreamInterface $body;

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
    public function withProtocolVersion($version)
    {
        $message = clone $this;
        $message->protocolVersion = $version;

        return $message;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        return array_key_exists($name, $this->headers);
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        $arr = array();
        $arr = explode(',', $this->headers[$name]));
        return $arr;
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        return $this->headers[$name];
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        $message = clone $this;
        $message->headers[$name] = $value;
        return $message;
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        $message = clone $this;
        if($message->headers[$name]) $message->headers[$name] =.$value;
        return $message;
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        $message = clone $this;
        unset($message->headers[$name]);
        return $message;
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        $message = clone $this;
        $message->body = $body;
        return $message;
    }
}