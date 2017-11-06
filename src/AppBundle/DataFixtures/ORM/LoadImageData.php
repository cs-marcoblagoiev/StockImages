<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Stock;

class LoadImageData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $image = (new Stock())
            ->setFilename('abstract-background-pink.jpg')
            ->setSlug('abstract-background-pink')
            ->setWidth(1920)
            ->setHeight(1080)
        ;

        $manager->persist($image);
        $manager->flush();
    }
}