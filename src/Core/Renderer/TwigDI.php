<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 27.01.18
 * Time: 23:34
 */

namespace Src\Core\Renderer;


use Src\Core\Config\Config;

class TwigDI
{
    const TEMPLATE_PATH_CONFIG = 'twig.templatePath';
    const TEMPLATE_CACHE_CONFIG = 'twig.cachePath';

    public static function getDI()
    {
        return [
            \Twig_Loader_Filesystem::class => function ($c)  {
                $config = $c->get(Config::class);
                return new \Twig_Loader_Filesystem($config->get(self::TEMPLATE_PATH_CONFIG));
            },
            \Twig_Environment::class => function ($c)  {
                $config = $c->get(Config::class);
                return  new \Twig_Environment($c->get(\Twig_Loader_Filesystem::class), array(
                    'debug' => $config->isDev(),
                    'cache' => $config->get(self::TEMPLATE_CACHE_CONFIG)
                ));
            }
        ];

    }

}