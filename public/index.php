<?php

use Generic\App;
use App\Controller\HomeController;
use GuzzleHttp\Psr7\ServerRequest;
use Generic\Middlewares\TrailingSlashMiddlewares;

require_once dirname(__DIR__) . '/vendor/autoload.php';

//Création de la requete HTTP
$request = ServerRequest::fromGlobals();

//création de la reponse
$app = new App([
    new TrailingSlashMiddlewares,
    new HomeController
]);
$response = $app->handle($request);

//Renvoi de la reponse au navigateur
\Http\Response\send($response);
