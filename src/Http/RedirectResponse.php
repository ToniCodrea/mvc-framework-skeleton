<?php


namespace Framework\Http;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class RedirectResponse extends Message implements ResponseInterface
{

    private $statusCode;
    private $reason;
    private $location;

    /**
     * Response constructor.
     * @param StreamInterface $body
     * @param string $protocolVersion
     * @param int $statusCode
     */
    public function __construct(string $location, string $protocolVersion = "1.1", int $statusCode = 302)
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
    }

    /**
     *
     */
    private function sendHeaders(): void
    {
        header($this->location);
    }

    /**
     *
     */
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