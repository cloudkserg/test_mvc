<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 3:37
 */

namespace Src\Service;

use Src\Model\Task;
use Src\Repository\TaskRepository;
use Src\Request\CreateTaskRequest;
use Src\Request\TaskRequest;
use Src\Request\UpdateTaskRequest;

class TaskService
{
    /**
     * @var TaskRepository
     */
    private $repository;
    /**
     * @var ImageService
     */
    private $imageService;

    public function __construct(TaskRepository $repository, ImageService $imageService)
    {
        $this->repository = $repository;
        $this->imageService = $imageService;
    }


    public function getTasks(TaskRequest $taskRequest) : array
    {
        return $this->repository->getItems(
            $taskRequest->getStart(),
            $taskRequest->getPageLimit(),
            $taskRequest->getOrderField(),
            $taskRequest->getOrderDir()
        );

    }

    public function countTasks() : int
    {
        return $this->repository->countItems();
    }


    public function findTask($id) : Task
    {
        return $this->repository->findById($id);
    }

    public function updateTask(Task $task, UpdateTaskRequest $taskRequest) : Task
    {
        $task->setText($taskRequest->getText());
        $task->setExecuted($taskRequest->isExecuted());
        return $this->repository->saveItem($task);
    }


    public function createTask(CreateTaskRequest $taskRequest): Task
    {
        $task = new Task();
        $task->setText($taskRequest->getText());
        $task->setUsername($taskRequest->getUsername());
        $task->setEmail($taskRequest->getEmail());

        $image = $this->imageService->saveImage($taskRequest->getImage());
        $task->setImage($image);

        return $this->repository->saveItem($task);
    }

}