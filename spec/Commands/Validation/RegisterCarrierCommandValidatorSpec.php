<?php

namespace spec\App\Commands\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegisterCarrierCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Commands\Validation\RegisterCarrierCommandValidator');
    }
}
