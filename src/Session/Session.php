<?php

namespace Framework\Session;

use Framework\Contracts\SessionInterface;

class Session implements SessionInterface {
    /**
     *
     */
    public function start(): void
    {
        session_start();
    }

    /**
     *
     */
    public function destroy(): void
    {
        session_destroy();
    }

    /**
     *
     */
    public function regenerate(): void
    {
        session_regenerate_id();
    }

    /**
     * @param string $name
     * @param $value
     */
    public function set(string $name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $_SESSION[$name];
    }

    /**
     * @param string $name
     */
    public function delete(string $name)
    {
        unset($_SESSION[$name]);
    }
}