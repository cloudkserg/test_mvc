<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 28.01.18
 * Time: 22:31
 */

namespace Src\Service;


use Src\Core\Image\ImageProcessor;
use Zend\Diactoros\UploadedFile;

class ImageService
{
    /**
     * @var ImageProcessor
     */
    private $processor;

    public function __construct(ImageProcessor $processor)
    {
        $this->processor = $processor;
    }


    public function saveImage(UploadedFile $image) : string
    {
        return $this->processor->saveImage($image);
    }

    public function getFullpathForWeb(string $image) : string
    {
        return $this->processor->getFullpathForWeb($image);
    }

}