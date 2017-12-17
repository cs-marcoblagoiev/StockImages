<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Stock;
use AppBundle\Service\FileDeleter;
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
    /**
     * @var FileDeleter
     */
    private $fileDeleter;

    public function __construct(
        FileMover $fileMover,
        ImageFilePathHelper $imageFilePathHelper,
        ImageFileDimensionsHelper $imageFileDimensionsHelper,
        FileDeleter $fileDeleter
    )
    {
        $this->fileMover = $fileMover;
        $this->imageFilePathHelper = $imageFilePathHelper;
        $this->imageFileDimensionsHelper = $imageFileDimensionsHelper;
        $this->fileDeleter = $fileDeleter;
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
        if ($entity->getFilename() !== null) {
            $this->fileDeleter->delete(
                $entity->getFilename()
            );
        }

        $file = $entity->getFile();


        $newFileLocation = $this->imageFilePathHelper->getNewFilePath(
            $file->getFilename()
        );

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

    public function preRemove(LifecycleEventArgs $eventArgs)
    {
        /**
         * @var $entity Stock
         */
        $entity = $eventArgs->getEntity();

        if (false === $entity instanceof Stock) {
            return false;
        }

        $entity->setFile(null);

        $this->fileDeleter->delete(
            $entity->getFilename()
        );
    }
}
