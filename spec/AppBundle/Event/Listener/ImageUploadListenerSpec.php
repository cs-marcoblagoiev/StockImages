<?php

namespace spec\AppBundle\Event\Listener;

use AppBundle\Entity\Category;
use AppBundle\Entity\Stock;
use AppBundle\Event\Listener\ImageUploadListener;
use AppBundle\Service\FileMover;
use AppBundle\Model\FileInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadListenerSpec extends ObjectBehavior
{
    private $fileMover;

    function let(FileMover $fileMover)
    {
        $this->beConstructedWith($fileMover);

        $this->fileMover = $fileMover;
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ImageUploadListener::class);
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
        $fakeRealPath = '/path/to/my/project/some.file';

        $file->getExistingFilePath()->willReturn($fakeTempPath);
        $file->getNewFilePath()->willReturn($fakeRealPath);

        $image = new Stock();
        $image->setFile($file->getWrappedObject());

        $eventArgs->getEntity()->willReturn($image);

        $this->prePersist($eventArgs)->shouldReturn(true);

        $this->fileMover->move($fakeTempPath, $fakeRealPath)->shouldHaveBeenCalled();

    }

    function it_can_preUpdate(PreUpdateEventArgs $eventArgs)
    {
        $this->preUpdate($eventArgs);
    }
}
