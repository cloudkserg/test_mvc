<?php
namespace Src\Action;



use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\Core\Auth\Authenticator;
use Src\Core\Exception\AuthException;
use Src\Core\Renderer\RendererInterface;
use Src\Request\LoginRequest;
use Src\Service\UserService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;

class LoginAction implements RequestHandlerInterface
{
    /**
     * @var UserService
     */
    private $service;
    /**
     * @var Authenticator
     */
    private $authenticator;

    public function __construct(UserService $service, Authenticator $authenticator)
    {
        $this->service = $service;
        $this->authenticator = $authenticator;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $loginRequest = new LoginRequest($request);
        if ($this->service->isAdmin($loginRequest->getLogin(), $loginRequest->getPassword())) {
            $this->authenticator->loginAsAdmin();
        } else {
            throw new AuthException('Not right username or password');
        }

        return new RedirectResponse('/');
    }


}
