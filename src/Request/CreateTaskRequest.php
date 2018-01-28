<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 3:48
 */

namespace Src\Request;


use Psr\Http\Message\ServerRequestInterface;
use Src\Core\Exception\ValidateException;
use Src\Core\Validator\ValidatorHelper;
use Symfony\Component\Validator\Constraints as Assert;
use Zend\Diactoros\UploadedFile;

class CreateTaskRequest
{

    const ALLOW_TYPES = ['image/png', 'image/jpeg', 'image/gif'];

    private $username;
    private $text;
    private $image;
    private $email;


    public function __construct(ServerRequestInterface $request)
    {
        $postParams = $request->getParsedBody();
        $files = $request->getUploadedFiles();
        $this->validateImage($files);
        $this->validate($postParams);

        $this->username = $postParams['username'];
        $this->text = $postParams['text'];
        $this->email = $postParams['email'];
        $this->image = $files['image'];
    }


    private function validate(array $params)
    {
        $constraint = new Assert\Collection([
            // the keys correspond to the keys in the input array
            'username' => new Assert\NotBlank(['message' => 'Не задано имя пользователя']),
            'email' => [new Assert\NotBlank(['message' => 'Не задан email']), new Assert\Email()],
            'text' => new Assert\NotBlank(['message' => 'Не задан текст']),
        ]);

        ValidatorHelper::validate($params, $constraint);
    }

    /**
     * @param UploadedFile[] $files
     * @return UploadedFile
     * @throws ValidateException
     */
    private function validateImage(array $files)
    {
        if (!isset($files['image'])) {
            throw new ValidateException('Не загружена картинка');
        }
        $image = $files['image'];
        if (!in_array($image->getClientMediaType(), self::ALLOW_TYPES)) {
            throw new ValidateException('Картинка не верного типа (только img, gif, jpg)');
        }
    }



    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }




}