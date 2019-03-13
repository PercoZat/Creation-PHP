<?php
namespace Generic;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Generic\Middlewares\TrailingSlashMiddlewares;

class App implements RequestHandlerInterface
{
    private $compteurMiddleware;
    private $middleware;
    /**
     * Le Contructeur pour initialiser les variables
     */
    public function __construct(array $middleware)
    {
        $this->compteurMiddleware = 0;
        $this->middleware = $middleware;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        //On récupere le middleware à appeler
        $middleware = $this->middleware[$this->compteurMiddleware];
        //incremantation du compteur
        $this->compteurMiddleware++;
        //On appelle le middleware
        $response = $middleware->process($request, $this);
        return $response;
    }
}
