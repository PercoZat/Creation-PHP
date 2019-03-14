<?php
use Generic\App;
use Generic\Router\Router;
use App\Controller\HomeController;
use Generic\Renderer\TwigRenderer;
use GuzzleHttp\Psr7\ServerRequest;
use App\Controller\AboutController;
use Generic\Router\RouterMiddleware;
use App\Controller\ContactController;
use Generic\Middlewares\TrailingSlashMiddlewares;

$rootDir = dirname(__DIR__);

require_once $rootDir.'/vendor/autoload.php';

//Création de la requete HTTP
$request = ServerRequest::fromGlobals();

// Initalisation de twig
$twig = new TwigRenderer($rootDir .'/templates');

// ajout des routes dans le route
$router = new Router();
$router->addRoute('/', new HomeController($twig), 'homepage');
$router->addRoute('/contact', new ContactController($twig), 'contact');
$router->addRoute('/a-propos', new AboutController($twig), 'about');

//création de la reponse
$app = new App([
    new TrailingSlashMiddlewares(),
    new RouterMiddleware($router)
]);

$response = $app->handle($request);

//Renvoi de la reponse au navigateur
\Http\Response\send($response);
