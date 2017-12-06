<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Stock;
use AppBundle\Service\ImageFilePathHelper;
use AppBundle\Service\LocalFilesystemFileMover;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ImageUploadListener
{
    /**
     * @var LocalFilesystemFileMover
     */
    private $fileMover;
    /**
     * @var ImageFilePathHelper
     */
    private $imageFilePathHelper;

    public function __construct(LocalFilesystemFileMover $fileMover, ImageFilePathHelper $imageFilePathHelper)
    {
        $this->fileMover = $fileMover;
        $this->imageFilePathHelper = $imageFilePathHelper;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if (false === $entity instanceof Stock) {
            return false;
        }

        /**
         * @var $entity Stock
         */

        // get access to the file
        $file = $entity->getFile();

        // todo:
        //  - figure out new file path
        $newFilePath = $this->imageFilePathHelper->getNewFilePath(
            $file->getClientOriginalName()
        );

        // move the uploaded file
        // args: $currentPath, $newPath
        $this->fileMover->move(
            $file->getPathname(),
            $newFilePath
        );

        [
            0 => $width,
            1 => $height,
        ] = getimagesize($newFilePath);


        // - update the Wallpaper entity with new info
        $entity->setFilename(
            $file->getClientOriginalName()
        )->setHeight($height)
        ->setWidth($width);

        return true;
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {

    }
}
