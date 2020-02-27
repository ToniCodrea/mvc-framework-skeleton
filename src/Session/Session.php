<?php

namespace Framework\Session;

use Framework\Contracts\SessionInterface;

class Session implements SessionInterface {

    public function start(): void
    {
        session_start();
    }

    public function destroy(): void
    {
        session_destroy();
    }

    public function regenerate(): void
    {
        session_regenerate_id();
    }

    public function set(string $name, $value): void
    {
        //todo
    }

    public function get(string $name)
    {
        // TODO: Implement get() method.
    }

    public function delete(string $name)
    {
        // TODO: Implement delete() method.
    }
}