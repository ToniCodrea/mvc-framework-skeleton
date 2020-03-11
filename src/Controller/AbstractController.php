<?php
declare(strict_types=1);

namespace Framework\Controller;

use Framework\Contracts\RendererInterface;
use Framework\Http\Message;
use Framework\Http\Response;
use Framework\Http\Stream;

/**
 * Base abstract class for application controllers.
 * All application controllers must extend this class.
 */
abstract class AbstractController
{
    /**
     * @var RendererInterface
     */
    protected $renderer;

    /**
     * AbstractController constructor.
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param string $location
     * @param int $statusCode
     * @return Response
     */
    protected function redirect (string $location, int $statusCode = 301) : Response {
        $body = Stream::createFromString("");
        /**
         * @var Response $response
         */
        $response = (new Response($body, '1.1', $statusCode))
            ->withAddedHeader('Location', $location);

        return $response;
    }

}
