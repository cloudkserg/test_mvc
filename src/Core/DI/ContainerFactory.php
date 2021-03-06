<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 27.01.18
 * Time: 15:41
 */

namespace Src\Core\DI;


use DI\ContainerBuilder;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Src\Core\Config\Config;

use DI;
use Src\Core\Error\ErrorMiddleware;
use Src\Core\Error\ErrorResponseGenerator;
use Src\Core\Log\LoggerFactory;
use Src\Core\Renderer\RendererInterface;
use Src\Core\Renderer\TwigDI;
use Src\Core\Renderer\TwigRenderer;
use Src\Core\Router\RouterDI;

class ContainerFactory
{


    public function create(Config $config) : ContainerInterface
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions($this->getDefinitions($config));
        return $builder->build();
    }


    private function getDefinitions(Config $config)
    {
        return array_merge(
            TwigDI::getDI(),
            (new RouterDI())->getDI(),
            [
                LoggerInterface::class => function ($c)  use ($config) {
                    return LoggerFactory::create($config);
                },
                Config::class => $config,
                ErrorResponseGenerator::class => function ($c) use ($config) {
                    return new ErrorResponseGenerator($config->isDev());
                },
                RendererInterface::class => DI\Object(TwigRenderer::class)
            ]
        );
    }

}