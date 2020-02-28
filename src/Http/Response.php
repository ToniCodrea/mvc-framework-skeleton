<?php

namespace Framework\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response extends Message implements ResponseInterface
{
    private $statusCode;
    private $reason;

    public function __construct(StreamInterface $body, string $protocolVersion = "1.1", $statusCode = 200)
    {
        parent::__construct($protocolVersion, $body);
        $this->statusCode = $statusCode;

    }

    public function send(): void
    {
        $this->sendHeaders();
        $this->sendBody();
    }

    private function sendHeaders(): void
    {
        if ($this->headers) {
            foreach ($this->headers as $header => $value) {
                header($header . ":". implode(",", $value));
            }
        }
    }

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
