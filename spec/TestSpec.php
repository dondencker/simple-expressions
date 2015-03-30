<?php

namespace spec\Dencker\SimpleExpressions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Dencker\SimpleExpressions\Test');
        $this->run();
    }
}
