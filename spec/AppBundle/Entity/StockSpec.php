<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\Stock;
use AppBundle\Model\FileInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StockSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Stock::class);
    }

    function it_sets_the_updated_at_timestamp_when_setting_a_file(
        FileInterface $file
    )
    {
        $this->getUpdatedAt()->shouldBe(null);
        $this
            ->setFile($file)
            ->shouldReturnAnInstanceOf(Stock::class)
        ;
        $this
            ->getUpdatedAt()
            ->shouldReturnAnInstanceOf(\DateTime::class)
        ;
    }
}
