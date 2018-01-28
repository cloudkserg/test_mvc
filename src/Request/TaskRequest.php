<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 21:38
 */

namespace Src\Request;


use Psr\Http\Message\ServerRequestInterface;

class TaskRequest
{

    private $start;

    private $draw;

    private $pageLimit;

    private $orderField;

    private $orderDir;



    public function __construct(ServerRequestInterface $request)
    {
        $query = $request->getQueryParams();
        $this->start = isset($query['start']) ? $query['start'] : null;
        $this->draw = isset($query['draw']) ? $query['draw'] : null;
        $this->pageLimit = isset($query['length']) ? $query['length'] : null;


        $this->orderField = $this->parseOrderColumn($query);
        $this->orderDir = $this->parseOrderDir($query);
    }


    private function parseOrderDir(array $query)
    {
        $order = isset($query['order']) ? $query['order'] : [];
        if (isset($order[0]['dir'])) {
            return $order[0]['dir'];
        }
        return null;
    }

    private function parseOrderColumn(array $query)
    {
        $order = isset($query['order']) ? $query['order'] : [];
        if (isset($order[0]['column'])) {
            $columnOrder = $order[0]['column'];
            if (isset($query['columns'][$columnOrder])) {
                return $query['columns'][$columnOrder]['data'];
            }
        }

        return null;
    }


    /**
     * @return mixed
     */
    public function getStart()
    {
        return (int)$this->start;
    }

    /**
     * @return mixed
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * @return mixed
     */
    public function getPageLimit()
    {
        return (int)$this->pageLimit;
    }

    /**
     * @return mixed
     */
    public function getOrderField()
    {
        return $this->orderField;
    }

    /**
     * @return mixed
     */
    public function getOrderDir()
    {
        return $this->orderDir;
    }



}