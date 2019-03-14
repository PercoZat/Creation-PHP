<?php
namespace Generic\Middlewares;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TrailingSlashMiddlewares implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Trouve URL
        $url = $request->getUri()->getPath();
        $lastCharacter = substr($url, -1);

        $response = $handler->handle($request);

        if ($lastCharacter === '/' && strlen($url) !== 1) {
            $newURL = substr($url, 0, -1);
            $response = new Response(301, ['location' => $newURL]);
        }
            return $response;
    }
}
