<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 20:34
 */

namespace Src\Core\Validator;

use Src\Core\Exception\ValidateException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class ValidatorHelper
{
    public static function validate($params, $constraint)
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($params, $constraint);
        if (count($violations) !== 0) {
            $errorString = collect($violations)->map(function (ConstraintViolation $violation) {
                return $violation->getPropertyPath() . ': ' . $violation->getMessage();
            })->implode(", <br />\n");

            $fields = collect($violations)->map(function (ConstraintViolation $violation) {
                return rtrim(ltrim($violation->getPropertyPath(), '['), ']');
            })->toArray();

            $e = new ValidateException('Переданы неверные данные: <br />' . $errorString);
            $e->fields = $fields;
            throw $e;
        }
    }

}