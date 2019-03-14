<?php
use Generic\App;
use Generic\Router\Router;
use App\Controller\HomeController;
use GuzzleHttp\Psr7\ServerRequest;
use App\Controller\AboutController;
use Generic\Router\RouterMiddleware;
use App\Controller\ContactController;
use Generic\Middlewares\TrailingSlashMiddlewares;

require_once dirname(__DIR__) . '/vendor/autoload.php';

//Création de la requete HTTP
$request = ServerRequest::fromGlobals();

// ajout des routes dans le route

$router = new Router();
$router->addRoute('/', new HomeController(), 'homepage');
$router->addRoute('/contact', new ContactController(), 'contact');
$router->addRoute('/about', new AboutController(), 'about');

//création de la reponse
$app = new App([
    new TrailingSlashMiddlewares(),
    new RouterMiddleware($router)
]);

$response = $app->handle($request);

//Renvoi de la reponse au navigateur
\Http\Response\send($response);
