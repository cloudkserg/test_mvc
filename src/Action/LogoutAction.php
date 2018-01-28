<?php
namespace Src\Action;



use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\Core\Auth\Authenticator;
use Src\Core\Renderer\RendererInterface;
use Src\Request\LoginRequest;
use Src\Service\UserService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;

class LogoutAction implements RequestHandlerInterface
{
    /**
     * @var Authenticator
     */
    private $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->authenticator->logout();
        return new RedirectResponse('/');

    }


}