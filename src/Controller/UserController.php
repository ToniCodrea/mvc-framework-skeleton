<?php


namespace Framework\Controller;


use Framework\Contracts\RendererInterface;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Renderer\Renderer;
use Framework\Routing\RouteMatch;

class UserController extends AbstractController {
    private $userid;

    public function __construct(RendererInterface $renderer, $id)
    {
        parent::__construct($renderer);
        $this->userid = $id;
    }

    public function get(RouteMatch $routeMatch, Request $request) : Response {
        return $this->renderer->renderView('user.phtml', $routeMatch->getRequestAttributes());
    }
}