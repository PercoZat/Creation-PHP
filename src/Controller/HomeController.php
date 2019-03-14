<?php
namespace App\Controller;

use Generic\Controller\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class HomeController extends Controller
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $products = [
            [
                "id" => 1,
                "name" => "Mercure",
                "description" => "Premiere planète"
            ],
            [
                "id" => 2,
                "name" => "Vénus",
                "description" => "Deuxième planète"
            ],
            [
                "id" => 3,
                "name" => "La Terre",
                "description" => "Troisème planète"
            ],
            [
                "id" => 4,
                "name" => "Mars",
                "description" => "Quatrième planète"
            ],
            [
                "id" => 5,
                "name" => "Jupiter",
                "description" => "Cinquième planète"
            ]
        ];
        return $this->render('home.twig', [
            'titre' => 'Bonjour',
            'products' => $products
        ]);
    }
}
