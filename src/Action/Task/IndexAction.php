<?php
namespace Src\Action\Task;



use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Src\Core\Renderer\RendererInterface;
use Src\Formatter\TaskFormatter;
use Src\Model\Task;
use Src\Request\TaskRequest;
use Src\Service\TaskService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

class IndexAction implements RequestHandlerInterface
{
    /**
     * @var TaskService
     */
    private $service;
    /**
     * @var TaskFormatter
     */
    private $taskFormatter;

    public function __construct(TaskService $service, TaskFormatter $taskFormatter)
    {
        $this->service = $service;
        $this->taskFormatter = $taskFormatter;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $taskRequest = new TaskRequest($request);
        $objects = $this->service->getTasks($taskRequest);
        $countObjects = $this->service->countTasks();


        return  new JsonResponse([
            'draw' => $taskRequest->getDraw(),
            'recordsFiltered' => $countObjects,
            'data' => collect($objects)->map(function (Task $task) {
                return $this->taskFormatter->trasform($task);
            })->toArray(),
            'recordsTotal' => $countObjects
        ]);
    }


}
