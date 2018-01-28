<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 29.01.18
 * Time: 0:38
 */

namespace Src\Repository;


use RedBeanPHP\OODBBean;
use RedBeanPHP\R;
use Src\Model\Task;

class TaskMapper
{
    const TASKS_TABLE = 'tasks';

    public function loadParamsFromBean(OODBBean $bean)
    {
        $task = new Task();
        $task->setId($bean->id);
        $task->setEmail($bean->email);
        $task->setUsername($bean->username);
        $task->setText($bean->text);
        $task->setExecuted((bool)$bean->executed);
        $task->setImage($bean->image);
        return $task;
    }


    public function createBean()
    {
        return R::dispense( self::TASKS_TABLE );
    }

    public function getBeanFromParams(OODBBean $bean, Task $task)
    {
        $bean->email = $task->getEmail();
        $bean->text = $task->getText();
        $bean->username = $task->getUsername();
        $bean->executed = $task->isExecuted();
        $bean->image = $task->getImage();
        return $bean;
    }

}