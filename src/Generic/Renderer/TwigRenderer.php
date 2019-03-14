<?php
namespace Generic\Renderer;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
/**
 * Classe permettant de faciliter l'utilisation de Twing
 */
class TwigRenderer
{

    private $twig;
    /**
     * __construct
     *
     * @param  string $path - Chemin du dossier des vues
     *
     * @return void
     */
    public function __construct(string $path)
    {
        $loader = new FilesystemLoader($path);
        $this->twig = new Environment($loader, [
            'cache' => false
        ]);
    }

    /**
     * render
     *Rendre une vue Twig (fichier avec extension ".twig") dans une chaîne de caracteres
     * @param  mixed $view - Ficgier Twig
     * @param  mixed $variables - Les variables que je veux envoyer à Twig
     *
     * @return string
     */
    public function render(string $view, array $variables = []): string
    {
        return $this->twig->render($view, $variables);
    }
}