<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 3:41
 */

namespace Src\Service;


use Src\Core\Config\Config;

class UserService
{

    const LOGIN = 'admin.login';
    const PASS = 'admin.pass';

    private $login;
    private $hash;

    public function __construct(Config $config)
    {
        $this->login = $config->get(self::LOGIN);
        $this->hash = $config->get(self::PASS);
    }


    public function isAdmin(string $login, string $password) : bool
    {
        return ($this->login == $login and ($this->encode($password) == $this->hash));
    }

    private function encode(string $password) : string
    {
        return md5($password);
    }

}