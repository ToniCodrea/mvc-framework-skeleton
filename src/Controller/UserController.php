<?php


namespace Framework\Controller;


use Framework\Contracts\RendererInterface;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Renderer\Renderer;
use Framework\Routing\RouteMatch;

class UserController extends AbstractController {

    public function __construct(RendererInterface $renderer)
    {
        parent::__construct($renderer);
    }

    public function delete (RouteMatch $routeMatch, Request $request) {
        return $this->renderer->renderJson($routeMatch->getRequestAttributes());
    }

    public function update (RouteMatch $routeMatch, Request $request) {
        return $this->renderer->renderView('user2.phtml', $routeMatch->getRequestAttributes());
    }

    public function get(RouteMatch $routeMatch, Request $request) : Response {
        return $this->renderer->renderView('user.phtml', $routeMatch->getRequestAttributes());
    }
}