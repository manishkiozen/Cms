<?php

namespace spec\App\Commands\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateShippingRuleCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Commands\Validation\UpdateShippingRuleCommandValidator');
    }

    function it_returns_the_validation_rules() {
        $this->getRules()->shouldReturn([
            'is_enabled' => 'boolean',
            'delivery_time' => 'integer|required|min:1',
        ]);
    }
}
