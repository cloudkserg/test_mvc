<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 21:36
 */

namespace Src\Formatter;


use Src\Model\Task;
use Src\Service\ImageService;

class TaskFormatter
{
    /**
     * @var ImageService
     */
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }


    public function trasform(Task $task)
    {
        return [
            'id' => (int)$task->getId(),
            'username' => htmlspecialchars($task->getUsername()),
            'email' => htmlspecialchars($task->getEmail()),
            'text' => htmlspecialchars($task->getText()),
            'image' => $this->imageService->getFullpathForWeb($task->getImage()),
            'executed' => (bool)$task->isExecuted()
        ];
    }

}