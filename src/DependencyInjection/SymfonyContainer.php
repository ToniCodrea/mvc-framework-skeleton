<?php
declare(strict_types=1);

namespace Framework\DependencyInjection;

use Framework\Contracts\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;

class SymfonyContainer implements ContainerInterface
{
    /**
     * @var  SymfonyContainerInterface
     */
    private $container;

    /**
     * @param  SymfonyContainerInterface $container
     */

    public function __construct(SymfonyContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $id
     * @param object|null $service
     * @return mixed|void
     */
    public function set(string $id, ?object $service)
    {
        $this->container->set($id, $service);
    }

    /**
     * @param string $id
     * @return mixed|object|null
     */
    public function get($id)
    {
        return $this->container->get($id);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has($id)
    {
        return $this->container->has($id);
    }
}
