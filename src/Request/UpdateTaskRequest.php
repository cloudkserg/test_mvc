<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 3:49
 */

namespace Src\Request;

use Src\Core\Exception\NotFoundException;
use Src\Core\Exception\ValidateException;
use Src\Core\Validator\ValidatorHelper;
use Symfony\Component\Validator\Constraints as Assert;
use Psr\Http\Message\ServerRequestInterface;

class UpdateTaskRequest
{
    private $text;
    private $executed = false;
    private $id;


    public function __construct(ServerRequestInterface $request)
    {
        $query = $request->getQueryParams();
        $params = $request->getParsedBody();

        $this->validateId($query);
        $this->validate($params);

        $this->text = $params['text'];
        $this->executed = isset($params['executed']) ? true : false;
        $this->id = (int)$query['id'];
    }

    private  function validateId(array $query)
    {
        if (!isset($query['id'])) {
            throw new NotFoundException('Not found item by empty id');
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    private function validate(array $params)
    {
        if (!isset($params['text'])) {
            throw new ValidateException('Не задан текст');
        }
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return bool
     */
    public function isExecuted(): bool
    {
        return $this->executed;
    }



}