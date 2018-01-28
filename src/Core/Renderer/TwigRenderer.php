<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 27.01.18
 * Time: 19:04
 */

namespace Src\Core\Renderer;


use Psr\Container\ContainerInterface;
use Src\Core\Config\Config;

class TwigRenderer implements RendererInterface
{

    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(string $viewName, array $viewParams): string
    {
        $template = $this->twig->load($viewName);
        return $template->render($viewParams);
    }


}