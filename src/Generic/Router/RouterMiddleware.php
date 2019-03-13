<?php
namespace Generic\Router;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouterMiddleware implements MiddlewareInterface
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    /**
     * Appel du controleur lié à la route ou renvoi d'une erreur 404
     *
     * @param  mixed $request
     * @param  mixed $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        //Récupération de l'éventuel contrôleur
        $controller = $this->router->match($request);
        //condition
        if (!is_null($controller)){
            $response = $controller->process($request, $handler);
        } else {
            $response = new Response(404, [], '<h1>ERREUR 404 PAGE INTROUVABLE!!!</h1>');
        }
        return $response;
    }
}