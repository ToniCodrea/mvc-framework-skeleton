<?php
declare(strict_types=1);

namespace Framework\Contracts;

/**
 * Interface for a 3rd party container adapter.
 * An instance of a class implementing this is expected by the Application.
 */
interface ContainerInterface extends \Psr\Container\ContainerInterface
{
    /**
     * @param string $id
     * @param object|null $service
     * @return mixed
     */
    public function set(string $id, ?object $service);
}
