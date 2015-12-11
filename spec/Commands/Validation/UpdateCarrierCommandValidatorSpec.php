<?php

namespace spec\App\Commands\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateCarrierCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Commands\Validation\UpdateCarrierCommandValidator');
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'name' => 'string|required',
            'is_default_carrier' => 'boolean',
        ]);
    }
}
