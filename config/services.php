<?php

use Framework\Contracts\DispatcherInterface;
use Framework\Contracts\RendererInterface;
use Framework\Controller\UserController;
use Framework\Dispatcher\Dispatcher;
use Framework\Renderer\Renderer;
use Framework\Router\Router;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Framework\Contracts\RouterInterface;

$config = require __DIR__. '/config.php';
$container = new ContainerBuilder();
$container->setParameter('config', $config);
$container->register(RouterInterface::class, Router::class)
            ->addArgument('%config%');
$container->setParameter('baseViewPath', __DIR__.'/views');
$container->register(RendererInterface::class, Renderer::class)
    ->addArgument('%baseViewPath%');
$container->register(\Framework\Controller\UserController::class,UserController::class)
    ->addArgument(new Reference(RendererInterface::class));
$container->setParameter('controllerNamespace', $config['dispatcher']['controllerNamespace']);
$container->setParameter('controllerSuffix', $config['dispatcher']['controllerSuffix']);
$container->register(DispatcherInterface::class, Dispatcher::class)
    ->addArgument('%controllerNamespace%')
    ->addArgument( '%controllerSuffix%')
    ->addMethodCall('addController', [new Reference(UserController::class)]);

return new \Framework\DependencyInjection\SymfonyContainer($container);