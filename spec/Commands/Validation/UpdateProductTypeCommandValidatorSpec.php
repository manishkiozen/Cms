<?php

namespace spec\App\Commands\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateProductTypeCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Commands\Validation\UpdateProductTypeCommandValidator');
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'description' => 'required|string',
        ]);
    }
}
