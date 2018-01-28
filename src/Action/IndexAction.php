<?php
namespace Src\Action;



use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\Core\Auth\Authenticator;
use Src\Core\Renderer\RendererInterface;
use Zend\Diactoros\Response\HtmlResponse;

class IndexAction implements RequestHandlerInterface
{


    /**
     * @var RendererInterface
     */
    private $renderer;
    /**
     * @var Authenticator
     */
    private $authenticator;

    public function __construct(RendererInterface $renderer, Authenticator $authenticator)
    {
        $this->renderer = $renderer;
        $this->authenticator = $authenticator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $text = $this->renderer->render('task/index.html.twig', [
            'isAdmin' => $this->authenticator->isAdmin()
        ]);
        return  new HtmlResponse($text);
    }


}
