<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 3:34
 */

namespace Src\Model;


class Task
{

    private $id;
    private $username = '';
    private $email = '';
    private $text = '';
    private $image = '';
    private $executed = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * @return mixed
     */
    public function getUsername() :string
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getImage() : string
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    /**
     * @return bool
     */
    public function isExecuted(): bool
    {
        return $this->executed;
    }

    /**
     * @param bool $executed
     */
    public function setExecuted(bool $executed)
    {
        $this->executed = $executed;
    }


}