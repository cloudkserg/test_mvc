<?php
namespace Src\Action\Task;



use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\Core\Exception\NotFoundException;
use Src\Core\Exception\ValidateException;
use Src\Core\Renderer\RendererInterface;
use Src\Request\CreateTaskRequest;
use Src\Service\TaskService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;

class SaveAction implements RequestHandlerInterface
{
    /**
     * @var TaskService
     */
    private $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $taskRequest = new CreateTaskRequest($request);
        $this->service->createTask($taskRequest);
        return new RedirectResponse('/');
    }


}
