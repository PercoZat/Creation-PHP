<?php
namespace Generic;

use GuzzleHttp\Psr7\Response;
use App\Controller\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class App implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $controller = new HomeController();
        return $controller->process($request, $this);
    }
}
