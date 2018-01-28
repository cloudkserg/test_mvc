<?php
/**
 * Created by PhpStorm.
 * User: kirya
 * Date: 29.01.18
 * Time: 0:47
 */

namespace Src\Core\Image;


use claviska\SimpleImage;
use Src\Core\Config\Config;
use Zend\Diactoros\UploadedFile;

class ImageProcessor
{
    const WIDTH_CONFIG = 'image.width';
    const HEIGHT_CONFIG = 'image.height';
    const PATH_CONFIG = 'image.path';
    const PATH_WEB_CONFIG = 'image.pathForWeb';

    private $width;
    private $height;
    private $imagePath;
    /**
     * @var SimpleImage
     */
    private $imageCore;

    private $imagePathForWeb;

    public function __construct(Config $config, SimpleImage $imageCore)
    {
        $this->width = $config->get(self::WIDTH_CONFIG);
        $this->height = $config->get(self::HEIGHT_CONFIG);
        $this->imagePath = $config->get(self::PATH_CONFIG);
        $this->imagePathForWeb = $config->get(self::PATH_WEB_CONFIG);
        $this->imageCore = $imageCore;
    }


    private function generateFilename($filename, $index = 0)
    {
        $filename = ($index == 0) ? $filename : $index . '_' .$filename;
        if (!file_exists($this->getFullImage($filename))) {
            return $filename;
        }
        return $this->generateFilename($filename, ++$index);
    }

    public function saveImage(UploadedFile $imageFile)
    {
        $newFilename = $this->generateFilename($imageFile->getClientFilename());
        $this->imageCore
            ->fromFile($imageFile->getStream()->getMetadata('uri'))
            ->bestFit($this->width, $this->height)
            ->toFile($this->getFullImage($newFilename));

        return $newFilename;
    }


    public function getFullImage($filename)
    {
        return $this->imagePath . '/' . $filename;
    }

    public function getFullpathForWeb($filename)
    {
        return  $this->imagePathForWeb . '/' . $filename;
    }

}