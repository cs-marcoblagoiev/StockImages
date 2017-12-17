<?php

namespace spec\AppBundle\Event\Listener;

use AppBundle\Entity\Category;
use AppBundle\Entity\Stock;
use AppBundle\Event\Listener\ImageListener;
use AppBundle\Service\FileDeleter;
use AppBundle\Service\FileMover;
use AppBundle\Model\FileInterface;
use AppBundle\Service\ImageFileDimensionsHelper;
use AppBundle\Service\ImageFilePathHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImageListenerSpec extends ObjectBehavior
{
    private $fileMover;
    private $imageFilePathHelper;
    private $imageFileDimensionsHelper;
    private $fileDeleter;

    function let(
        FileMover $fileMover,
        ImageFilePathHelper $imageFilePathHelper,
        ImageFileDimensionsHelper $imageFileDimensionsHelper,
        FileDeleter $fileDeleter
    )
    {
        $this->beConstructedWith(
            $fileMover,
                $imageFilePathHelper,
                $imageFileDimensionsHelper,
                $fileDeleter
        );

        $this->fileMover = $fileMover;
        $this->imageFilePathHelper = $imageFilePathHelper;
        $this->imageFileDimensionsHelper = $imageFileDimensionsHelper;
        $this->fileDeleter = $fileDeleter;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ImageListener::class);
    }

    function it_returns_early_if_prePersist_LifecycleEventArgs_entity_is_not_a_Wallpaper_instance(
        LifecycleEventArgs $eventArgs
    )
    {
        $eventArgs->getEntity()->willReturn(new Category());

        $this->prePersist($eventArgs)->shouldReturn(false);

        $this->fileMover->move(
            Argument::any(),
            Argument::any()
        )->shouldNotHaveBeenCalled();
    }

    function it_can_prePersist(LifecycleEventArgs $eventArgs,
                               FileInterface $file)
    {
        $fakeTempPath = '/tmp/some.file';
        $fakeFilename = 'some.file';

        $file->getPathname()->willReturn($fakeTempPath);
        $file->getFilename()->willReturn($fakeFilename);

        $wallpaper = new Stock();
        $wallpaper->setFile($file->getWrappedObject());

        $eventArgs->getEntity()->willReturn($wallpaper);

        $fakeNewFileLocation = '/some/new/fake/' . $fakeFilename;
        $this
            ->imageFilePathHelper
            ->getNewFilePath($fakeFilename)
            ->willReturn($fakeNewFileLocation)
        ;

        $this->imageFileDimensionsHelper->setImageFilePath($fakeNewFileLocation)->shouldBeCalled();
        $this->imageFileDimensionsHelper->getWidth()->willReturn(1024);
        $this->imageFileDimensionsHelper->getHeight()->willReturn(768);

        $outcome = $this->prePersist($eventArgs);

        $this
            ->fileDeleter
            ->delete(Argument::any())
            ->shouldNotHaveBeenCalled()
        ;

        $this->fileMover->move($fakeTempPath, $fakeNewFileLocation)->shouldHaveBeenCalled();

        $outcome->shouldBeAnInstanceOf(Stock::class);
        $outcome->getFilename()->shouldReturn($fakeFilename);
        $outcome->getWidth()->shouldReturn(1024);
        $outcome->getHeight()->shouldReturn(768);
    }

    function it_returns_early_if_preUpdate_LifecycleEventArgs_entity_is_not_a_Wallpaper_instance(
        PreUpdateEventArgs $eventArgs
    )
    {
        $eventArgs->getEntity()->willReturn(new Category());

        $this->preUpdate($eventArgs)->shouldReturn(false);

        $this->fileMover->move(
            Argument::any(),
            Argument::any()
        )->shouldNotHaveBeenCalled();
    }

    function it_can_preUpdate(
        PreUpdateEventArgs $eventArgs,
        FileInterface $file)
    {
        $fakeTempPath = '/tmp/some.file';
        $fakeFilename = 'some.file';

        $file->getPathname()->willReturn($fakeTempPath);
        $file->getFilename()->willReturn($fakeFilename);

        $wallpaper = new Stock();
        $wallpaper->setFile($file->getWrappedObject());
        $wallpaper->setFilename($fakeFilename);

        $eventArgs->getEntity()->willReturn($wallpaper);

        $fakeNewFileLocation = '/some/new/fake/' . $fakeFilename;
        $this
            ->imageFilePathHelper
            ->getNewFilePath($fakeFilename)
            ->willReturn($fakeNewFileLocation)
        ;

        $this->imageFileDimensionsHelper->setImageFilePath($fakeNewFileLocation)->shouldBeCalled();
        $this->imageFileDimensionsHelper->getWidth()->willReturn(1024);
        $this->imageFileDimensionsHelper->getHeight()->willReturn(768);

        $outcome = $this->preUpdate($eventArgs);

        $this
            ->fileDeleter
            ->delete($fakeFilename)
            ->shouldHaveBeenCalled()
        ;

        $this->fileMover->move($fakeTempPath, $fakeNewFileLocation)->shouldHaveBeenCalled();

        $outcome->shouldBeAnInstanceOf(Stock::class);
        $outcome->getFilename()->shouldReturn($fakeFilename);
        $outcome->getWidth()->shouldReturn(1024);
        $outcome->getHeight()->shouldReturn(768);
    }

    function it_can_preRemove(
        LifecycleEventArgs $eventArgs,
        Stock $stock)
    {
        $stock->setFile(null)->shouldBeCalled();
        $stock->getFilename()->willReturn('fake-filename.jpg');
        $eventArgs->getEntity()->willReturn($stock);

        $this->preRemove($eventArgs);

        $this
            ->fileDeleter
            ->delete('fake-filename.jpg')
            ->shouldHaveBeenCalled()
        ;
    }


    function it_will_not_continue_with_preRemove_if_not_a_Stock_instance(
        LifecycleEventArgs $eventArgs,
        Category $category
    )
    {
        $eventArgs->getEntity()->willReturn($category);

        $this->preRemove($eventArgs);

        $this
            ->fileDeleter
            ->delete(Argument::any())
            ->shouldNotHaveBeenCalled()
        ;
    }
}
