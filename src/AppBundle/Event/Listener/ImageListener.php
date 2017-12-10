<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Stock;
use AppBundle\Service\FileMover;
use AppBundle\Service\ImageFileDimensionsHelper;
use AppBundle\Service\ImageFilePathHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ImageListener
{
    /**
     * @var FileMover
     */
    private $fileMover;
    /**
     * @var ImageFilePathHelper
     */
    private $imageFilePathHelper;
    /**
     * @var ImageFileDimensionsHelper
     */
    private $imageFileDimensionsHelper;

    public function __construct(
        FileMover $fileMover,
        ImageFilePathHelper $imageFilePathHelper,
        ImageFileDimensionsHelper $imageFileDimensionsHelper
    )
    {
        $this->fileMover = $fileMover;
        $this->imageFilePathHelper = $imageFilePathHelper;
        $this->imageFileDimensionsHelper = $imageFileDimensionsHelper;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        return $this->upload(
            $eventArgs->getEntity()
        );
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        return $this->upload(
            $eventArgs->getEntity()
        );
    }

    private function upload($entity)
    {
        // if not Stock entity, return false
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

        $this->imageFileDimensionsHelper->setImageFilePath($newFileLocation);
        $entity
            ->setFilename(
                $file->getFilename()
            )
            ->setHeight(
                $this->imageFileDimensionsHelper->getHeight()
            )
            ->setWidth(
                $this->imageFileDimensionsHelper->getWidth()
            )
        ;
        return $entity;
    }
}
