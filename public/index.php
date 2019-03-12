<?php

use Generic\App;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

require_once dirname(__DIR__) . '/vendor/autoload.php';

//Création de la requete HTTP
$request = ServerRequest::fromGlobals();

//création de la reponse
$app = new App();
$response = $app->handle($request);

//Renvoi de la reponse au navigateur
\Http\Response\send($response);
