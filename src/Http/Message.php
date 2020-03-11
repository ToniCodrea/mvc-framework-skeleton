<?php

declare(strict_types = 1);

namespace Framework\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class Message implements MessageInterface
{
    protected $protocolVersion;
    protected $headers;
    protected $body;

    /**
     * Message constructor.
     * @param string $protocolVersion
     * @param StreamInterface $body
     */
    public function __construct(string $protocolVersion, StreamInterface $body)
    {
        $this->protocolVersion = $protocolVersion;
        $this->body = $body;
    }

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
        return $this->headers[$name];
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        return implode(",", $this->headers[$name]);
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        $message = clone $this;
        $message = $message->withoutHeader($name);
        $message = $message->withAddedHeader($name, $value);

        return $message;
    }

    /**
     * @inheritDoc
     */

    public function withAddedHeader($name, $value)
    {
        $message = clone $this;
        foreach ($value as $values) {
            if(!isset($message->headers[$name])) {
                $message->headers[$name][] = $values;
            }
            else {
                $message->headers[$name] = $value;
            }
        }

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