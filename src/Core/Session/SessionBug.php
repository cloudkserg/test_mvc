<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 29.01.18
 * Time: 2:01
 */

namespace Src\Core\Session;


class SessionBug
{

    public function destroy()
    {
        session_destroy();
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

}