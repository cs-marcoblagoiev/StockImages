<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Stock;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $image = (new Stock())
        ->setFilename('aed58e014ce4f61d66a2add5302557f0.jpg')
        ->setSlug('aed58e014ce4f61d66a2add5302557f0')
        ->setWidth(1920)
        ->setHeight(1080)
        ->setCategory($this->getReference('category.animals'))
    ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('animals-rabbits.jpg')
            ->setSlug('animals-rabbits')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('free-stock-photosnature-squirrels.jpg')
            ->setSlug('free-stock-photosnature-squirrels')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('house_blue.jpg')
            ->setSlug('house_blue')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('house_City_2209_hirez.jpg')
            ->setSlug('house_City_2209_hirez')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('house_modern.jpg')
            ->setSlug('house_modern')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('house_pexels-photo-261146.jpeg')
            ->setSlug('house_pexels-photo-261146')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('house_suburban.jpg')
            ->setSlug('house_suburban')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('house_Tiny House.jpg')
            ->setSlug('house_Tiny_House')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('nature_maxresdefault.jpg')
            ->setSlug('nature_maxresdefault')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('nature_pexels-photo-284399.jpeg')
            ->setSlug('nature_pexels-photo-284399')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('nature_river.jpg')
            ->setSlug('nature_river')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('nature-full01.png')
            ->setSlug('nature-full01')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('nature-photos.jpg')
            ->setSlug('nature-photos')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('pexels-photo-312121.jpeg')
            ->setSlug('pexels-photo-312121')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('trees-land-stock.jpg')
            ->setSlug('trees-land-stock')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('videoblocks-sunny.png')
            ->setSlug('videoblocks-sunny')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $image = (new Stock())
            ->setFilename('wildlife-animals.png')
            ->setSlug('wildlife-animals')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);



        $manager->flush();
    }

    public function getOrder()
    {
        return 200;
    }
}