<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 29.01.18
 * Time: 0:40
 */

namespace Src\Repository;


class TaskQueryBuilder
{

    public function createOrderString($field, $dir)
    {
        $field = $field ?? 'id';
        $dir = ($dir == 'desc') ? 'DESC' : 'ASC';


        if (in_array($field, [
            'id',
            'username',
            'email',
            'executed'
        ])) {
            return $field . " " . $dir;
        }
        return 'id DESC';
    }

}