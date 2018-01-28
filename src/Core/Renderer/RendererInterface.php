<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 27.01.18
 * Time: 19:04
 */

namespace Src\Core\Renderer;


interface RendererInterface
{


    public function render(string $viewName, array $viewParams): string;

}