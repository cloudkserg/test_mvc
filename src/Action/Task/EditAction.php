<?php
namespace Src\Action\Task;



use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\Core\Auth\Authenticator;
use Src\Core\Exception\NotFoundException;
use Src\Core\Renderer\RendererInterface;
use Src\Formatter\TaskFormatter;
use Src\Service\TaskService;
use Zend\Diactoros\Response\HtmlResponse;

class EditAction implements RequestHandlerInterface
{


    /**
     * @var RendererInterface
     */
    private $renderer;
    /**
     * @var TaskService
     */
    private $service;
    /**
     * @var Authenticator
     */
    private $authenticator;

    public function __construct(RendererInterface $renderer, TaskService $service, Authenticator $authenticator)
    {
        $this->renderer = $renderer;
        $this->service = $service;
        $this->authenticator = $authenticator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!isset($request->getQueryParams()['id'])) {
            throw new NotFoundException('This item not found.');
        }
        $id = (int)$request->getQueryParams()['id'];

        $item = $this->service->findTask($id);


        $text = $this->renderer->render('task/edit.html.twig', [
            'item' => $item,
            'isAdmin' => $this->authenticator->isAdmin()
        ]);
        return  new HtmlResponse($text);
    }


}
