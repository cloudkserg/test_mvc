<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 22:18
 */

namespace Src\Repository;


use League\Flysystem\Filesystem;
use Noodlehaus\FileParser\Json;
use RedBeanPHP\OODBBean;
use Src\Core\Exception\NotFoundException;
use Src\Model\Task;
use RedBeanPHP\R;

class TaskRepository
{
    const TASKS_TABLE = 'tasks';
    /**
     * @var TaskMapper
     */
    private $mapper;
    /**
     * @var TaskQueryBuilder
     */
    private $queryBuilder;

    public function __construct(TaskMapper $mapper, TaskQueryBuilder $queryBuilder)
    {
        $this->mapper = $mapper;
        $this->queryBuilder = $queryBuilder;
    }



    public function getItems($offset = 0, $limit = 3, $field = 'id', $dir = 'desc'): array
    {
        $offset = $offset ?? 0;
        $limit = $limit ?? 3;
        $sqlString = sprintf(
            'ORDER BY %s LIMIT ? OFFSET ?',
            $this->queryBuilder->createOrderString($field, $dir
        ));
        $items = R::findAll(
            self::TASKS_TABLE,
            $sqlString,
            [
                $limit,
                $offset
            ]

        );

        return collect($items)->map(function (OODBBean  $bean) {
            return $this->mapper->loadParamsFromBean($bean);
        })->values()->toArray();
    }

    public function createItem(Task $item) : Task
    {
        $bean = $this->mapper->createBean();
        $bean = $this->mapper->getBeanFromParams($bean, $item);
        R::store($bean);

        return $this->mapper->loadParamsFromBean($bean);
    }


    public function countItems() : int
    {
        return R::count(self::TASKS_TABLE);
    }

    public function saveItem(Task $item) : Task
    {
        $bean = R::load(self::TASKS_TABLE, $item->getId());
        $bean = $this->mapper->getBeanFromParams($bean, $item);
        R::store($bean);

        return $this->mapper->loadParamsFromBean($bean);
    }

    public function findById(int $id) : Task
    {
        $bean = R::load( self::TASKS_TABLE, $id );
        if (!isset($bean)) {
            throw new NotFoundException('Not found task by id' . $id);
        }
        return $this->mapper->loadParamsFromBean($bean);
    }


}