<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\File\SymfonyUploadedFile;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Stock;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        /**
         * @var $fs Filesystem
         */
        $fs = $this->container->get('filesystem');

        $imagesPath = __DIR__ . '/../images';
        $temporaryImagesPath = sys_get_temp_dir() . '/images';
        echo 'Copying images to temporary location.' . PHP_EOL;
        $fs->mirror($imagesPath, $temporaryImagesPath);

//        exec('cp -R ' . $imagesPath . ' ' . $temporaryImagesPath);


        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/aed58e014ce4f61d66a2add5302557f0.jpg',
                'aed58e014ce4f61d66a2add5302557f0.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('aed58e014ce4f61d66a2add5302557f0.jpg')
            ->setSlug('aed58e014ce4f61d66a2add5302557f0')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/animals-rabbits.jpg',
                'animals-rabbits.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('animals-rabbits.jpg')
            ->setSlug('animals-rabbits')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/free-stock-photosnature-squirrels.jpg',
                'free-stock-photosnature-squirrels.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('free-stock-photosnature-squirrels.jpg')
            ->setSlug('free-stock-photosnature-squirrels')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/house_blue.jpg',
                'house_blue.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('house_blue.jpg')
            ->setSlug('house_blue')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/house_City_2209_hirez.jpg',
                'house_City_2209_hirez.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('house_City_2209_hirez.jpg')
            ->setSlug('house_City_2209_hirez')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/house_modern.jpg',
                'house_modern.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('house_modern.jpg')
            ->setSlug('house_modern')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/house_pexels-photo-261146.jpeg',
                'house_pexels-photo-261146.jpeg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('house_pexels-photo-261146.jpeg')
            ->setSlug('house_pexels-photo-261146')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/house_suburban.jpg',
                'house_suburban.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('house_suburban.jpg')
            ->setSlug('house_suburban')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.houses'))
        ;

        $manager->persist($image);


        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/nature_maxresdefault.jpg',
                'nature_maxresdefault.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('nature_maxresdefault.jpg')
            ->setSlug('nature_maxresdefault')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/nature_pexels-photo-284399.jpeg',
                'nature_pexels-photo-284399.jpeg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('nature_pexels-photo-284399.jpeg')
            ->setSlug('nature_pexels-photo-284399')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/nature_river.jpg',
                'nature_river.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('nature_river.jpg')
            ->setSlug('nature_river')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/nature-full01.png',
                'nature-full01.png'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('nature-full01.png')
            ->setSlug('nature-full01')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/nature-photos.jpg',
                'nature-photos.jpg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('nature-photos.jpg')
            ->setSlug('nature-photos')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.nature'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/pexels-photo-312121.jpeg',
                'pexels-photo-312121.jpeg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('pexels-photo-312121.jpeg')
            ->setSlug('pexels-photo-312121')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/trees-land-stock.jpg',
                'trees-land-stock.jpgg'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('trees-land-stock.jpg')
            ->setSlug('trees-land-stock')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/videoblocks-sunny.png',
                'videoblocks-sunny.png'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('videoblocks-sunny.png')
            ->setSlug('videoblocks-sunny')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);

        $file = (new SymfonyUploadedFile())->setFile(
            new UploadedFile(
                $temporaryImagesPath . '/wildlife-animals.png',
                'wildlife-animals.png'
            )
        );

        $image = (new Stock())
            ->setFile($file)
            ->setFilename('wildlife-animals.png')
            ->setSlug('wildlife-animals')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.animals'))
        ;

        $manager->persist($image);



        $manager->flush();

        echo 'Removed images from temporary location.' . PHP_EOL;
        $fs->remove($temporaryImagesPath);
    }

    public function getOrder()
    {
        return 200;
    }
}