<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Stock;
use AppBundle\Service\FileMover;
use AppBundle\Service\ImageFilePathHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ImageUploadListener
{
    /**
     * @var FileMover
     */
    private $fileMover;
    /**
     * @var ImageFilePathHelper
     */
    private $imageFilePathHelper;

    public function __construct(FileMover $fileMover, ImageFilePathHelper $imageFilePathHelper)
    {
        $this->fileMover = $fileMover;
        $this->imageFilePathHelper = $imageFilePathHelper;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        // if not Wallpaper entity, return false
        if (false === $entity instanceof Stock) {
            return false;
        }
        /**
         * @var $entity Stock
         */
        $file = $entity->getFile();


        $newFileLocation = $this->imageFilePathHelper->getNewFilePath(
            $file->getFilename()
        );
        // got here
        $this->fileMover->move(
            $file->getPathname(),
            $newFileLocation
        );
        return true;
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {

    }
}
