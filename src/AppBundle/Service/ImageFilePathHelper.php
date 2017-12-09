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
        $this->imageFileDirectory = $this->ensureHasTrailingSlash(
            $imageFileDirectory
        );
    }

    public function getNewFilePath(string $newFileName)
    {
        $newFileName = $this->ensureHasNoLeadingSlash($newFileName);
        return $this->imageFileDirectory . $newFileName;
    }

    private function ensureHasTrailingSlash(string $path)
    {
        if (substr($path, -1) === '/') {
            return $path;
        }
        return $path . '/';
    }

    private function ensureHasNoLeadingSlash(string $path)
    {
        if (substr($path, 0, 1) === '/') {
            return substr($path, 1);
        }
        return $path;
    }


}
