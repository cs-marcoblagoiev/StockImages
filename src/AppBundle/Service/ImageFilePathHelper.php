<?php

namespace AppBundle\Service;

class ImageFilePathHelper
{

    /**
     * @var string
     */
    private $imageFileDirectory;

    public function __construct(string $imageFileDirectory)
    {
        $this->imageFileDirectory = $imageFileDirectory;
    }

    public function getNewFilePath(string $newFileName)
    {
        return $this->imageFileDirectory . $newFileName;
    }
}