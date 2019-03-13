<?php
namespace Generic\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;


class TrailingSlashMiddlewares implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Trouve URL
        $url = $request->getUri()->getPath();

        $lastCharacter = substr($url, -1);

        if ($lastCharacter === '/') {
            $newURL = substr($url, 0, -1);
            $response = new Response(301, ['location' => $newURL]);
            return $response;
        } else {
            return $handler->handle($request);
        }

        
// var_dump($newURL);
        die('On est dans TrailingSlash Middleware');
    }
}