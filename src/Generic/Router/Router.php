<?php
namespace Generic\Router;

use Zend\Expressive\Router\Route;
use Psr\Http\Server\MiddlewareInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Psr\Http\Message\ServerRequestInterface;

class Router
{

    private $routerVendor;

    public function __construct()
    {
        $this->routerVendor = new FastRouteRouter();
    }
    /**
     * Ajoute une route dans le router
     */
    public function addRoute(string $url, MiddlewareInterface $controller, ?string $name = null): void
    {
        // création de l'objet route
        $route = new Route($url, $controller, null, $name);
        //appel de la fonction du "vrai" routeur
        $this->routerVendor->addRoute($route);
    }

    /**
     * Renvoi le controleur lié à l'URL donnée
     */

    public function match(ServerRequestInterface $request): ?MiddlewareInterface
    {

        $result = $this->routerVendor->match($request);

        if ($result->isSuccess()) {
            //J'ai une route
            $controller = $result->getMatchedRoute()->getMiddleware();
        } else {
            //j'ai pas de route
            $controller = null;
        }
        return $controller;
    }
}
