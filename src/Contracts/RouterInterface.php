<?php

namespace Framework\Contracts;

use Framework\Http\Request;
use Framework\Routing\RouteMatch;

interface RouterInterface
{
    /**
     * @param Request $request
     * @return RouteMatch
     */
    public function route(Request $request): RouteMatch;
}
