<?php

namespace spec\App\Commands\Validation;

use App\Attribute;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegisterAttributeCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Commands\Validation\RegisterAttributeCommandValidator');
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'description' => 'required|string',
            'type' => 'required|in:' . implode(',', Attribute::getAllowedTypes()),
        ]);
    }
}
