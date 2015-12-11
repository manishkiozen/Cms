<?php

namespace spec\App;

use App\Carrier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CarrierSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Carrier');
    }

    function it_can_be_registered()
    {
        $carrier = Carrier::register('Acme Transport');
        \PHPUnit_Framework_Assert::assertEquals('Acme Transport', $carrier->name);
    }
}
