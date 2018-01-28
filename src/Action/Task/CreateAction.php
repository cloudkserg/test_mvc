<?php
namespace Src\Action\Task;



use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\Core\Auth\Authenticator;
use Src\Core\Renderer\RendererInterface;
use Zend\Diactoros\Response\HtmlResponse;

class CreateAction implements RequestHandlerInterface
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
        $text = $this->renderer->render('task/create.html.twig', [
            'isAdmin' => $this->authenticator->isAdmin()
        ]);
        return  new HtmlResponse($text);
    }


}
