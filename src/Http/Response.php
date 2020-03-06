<?php

namespace Framework\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response extends Message implements ResponseInterface
{
    private $statusCode;
    private $reason;
    private $location;

    /**
     * Response constructor.
     * @param StreamInterface $body
     * @param string $protocolVersion
     * @param int $statusCode
     * @param null $location
     */
    public function __construct(StreamInterface $body, string $protocolVersion = "1.1", $statusCode = 200, $location = null)
    {
        parent::__construct($protocolVersion, $body);
        $this->statusCode = $statusCode;
        $this->location = $location;

    }

    /**
     *
     */
    public function send(): void
    {
        $this->sendHeaders();
        $this->sendBody();
    }

    /**
     *
     */
    private function sendHeaders(): void
    {
        if ($this->location) {
            header($this->location);
        }
        if ($this->headers) {
            foreach ($this->headers as $header => $value) {
                header($header . ":". implode(",", $value));
            }
        }
    }

    /**
     *
     */
    private function sendBody(): void
    {
        echo $this->body;
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @inheritDoc
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        $response = clone $this;
        $response->statusCode = $code;
        $response->reason = $reasonPhrase;

        return $response;
    }

    /**
     * @inheritDoc
     */
    public function getReasonPhrase()
    {
        return $this->reason;
    }
}
