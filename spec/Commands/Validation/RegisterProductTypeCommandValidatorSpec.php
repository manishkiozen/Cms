<?php

namespace spec\App\Commands\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegisterProductTypeCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Commands\Validation\RegisterProductTypeCommandValidator');
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'description' => 'required|string|unique:product_types',
        ]);
    }
}
