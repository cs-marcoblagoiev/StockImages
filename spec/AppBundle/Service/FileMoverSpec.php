<?php

namespace spec\AppBundle\Service;

use AppBundle\Service\FileMover;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileMoverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FileMover::class);
    }

    function it_can_move_a_file_from_temporary_to_controlled_storage()
    {
        $currentLocation = "/some/fake/tmp/path";
        $newLocation = "/some/fake/new/path";

        $this->move($currentLocation, $newLocation)->shouldReturn(true);
    }
}
