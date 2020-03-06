<?php

namespace Framework;

use Exception;
use Framework\Contracts\DispatcherInterface;
use Framework\Contracts\RouterInterface;
use Framework\Contracts\SessionInterface;
use Framework\DependencyInjection\SymfonyContainer;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Router\NoRouteException;
use Framework\Routing\RouteMatch;
use Framework\Contracts\ContainerInterface;

class Application
{
    /**
     * @var SymfonyContainer
     */
    private $container;

    /**
     * Application constructor.
     * @param SymfonyContainer $container
     */
    public function __construct(SymfonyContainer $container)
    {
        $this->container = $container;
    }

    /**
     * @param SymfonyContainer $container
     * @return static
     */
    public static function create(SymfonyContainer $container): self
    {
        $application = new self($container);
        $container->set(self::class, $application);

        return $application;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $routeMatch = $this->getRouter()->route($request);
        /** @var SessionInterface $session */
        $session = $this->container->get(SessionInterface::class);
        $session->start();
        return $this->getDispatcher()->dispatch($routeMatch, $request);
    }

    /**
     * @return RouterInterface
     */
    private function getRouter(): RouterInterface
    {
        return $this->container->get(RouterInterface::class);
    }

    /**
     * @return DispatcherInterface
     */
    private function getDispatcher(): DispatcherInterface
    {
        return $this->container->get(DispatcherInterface::class);
    }
}
