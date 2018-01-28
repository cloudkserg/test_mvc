<?php
namespace Src\Action\Task;



use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\Core\Renderer\RendererInterface;
use Src\Request\UpdateTaskRequest;
use Src\Service\TaskService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;

class UpdateAction implements RequestHandlerInterface
{


    /**
     * @var RendererInterface
     */
    private $renderer;
    /**
     * @var TaskService
     */
    private $service;

    public function __construct(RendererInterface $renderer, TaskService $service)
    {
        $this->renderer = $renderer;
        $this->service = $service;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $taskRequest = new UpdateTaskRequest($request);

        $item = $this->service->findTask($taskRequest->getId());
        $this->service->updateTask($item, $taskRequest);

        return new RedirectResponse('/');
    }


}
