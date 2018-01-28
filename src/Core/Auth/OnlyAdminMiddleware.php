<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 22:07
 */

namespace Src\Core\Auth;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\Action\Task\EditAction;
use Src\Action\Task\UpdateAction;
use Src\Core\Exception\AuthException;

class OnlyAdminMiddleware implements MiddlewareInterface
{
    const FAST_ROUTE_PARAM = 'request-handler';
    /**
     * @var Authenticator
     */
    private $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    private function getDenyActions()
    {
        return [
            EditAction::class,
            UpdateAction::class
        ];
    }


    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $requestHandler = $request->getAttribute(self::FAST_ROUTE_PARAM);
        if (in_array(get_class($requestHandler), $this->getDenyActions()) and !$this->authenticator->isAdmin()) {
            throw new AuthException();
        }

        return $handler->handle($request);
    }


}