<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 29.01.18
 * Time: 1:15
 */

namespace Src\Core\Auth;


use Src\Core\Session\SessionBug;

class Authenticator
{
    const ADMIN_PARAM = 'isAdmin';
    /**
     * @var SessionBug
     */
    private $sessionBug;

    public function __construct(SessionBug $sessionBug)
    {
        $this->sessionBug = $sessionBug;
    }

    public function isAdmin() : bool
    {
        return ($this->sessionBug->get(self::ADMIN_PARAM) === true);
    }


    public function loginAsAdmin()
    {
        $this->sessionBug->set(self::ADMIN_PARAM, true);
    }

    public function logout()
    {
        $this->sessionBug->destroy();
    }


}