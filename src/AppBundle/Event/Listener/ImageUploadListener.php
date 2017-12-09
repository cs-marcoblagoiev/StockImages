<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Stock;
use AppBundle\Service\FileMover;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ImageUploadListener
{
    /**
     * @var FileMover
     */
    private $fileMover;

    public function __construct(FileMover $fileMover)
    {
        $this->fileMover = $fileMover;
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
        // got here
        $this->fileMover->move(
            $file->getExistingFilePath(),
            $file->getNewFilePath()
        );
        return true;
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {

    }
}
