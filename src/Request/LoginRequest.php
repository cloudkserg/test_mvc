<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 29.01.18
 * Time: 1:31
 */

namespace Src\Request;


use Psr\Http\Message\ServerRequestInterface;
use Src\Core\Exception\ValidateException;

class LoginRequest
{

    private $login;

    private $password;


    public function __construct(ServerRequestInterface $request)
    {
        $params = $request->getParsedBody();
        $this->validate($params);

        $this->login = $params['login'];
        $this->password = $params['password'];
    }


    private function validate(array $params)
    {
        if (!isset($params['login']) or !isset($params['password'])) {
            throw new ValidateException('Не задан пароль или логин');
        }
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }




}