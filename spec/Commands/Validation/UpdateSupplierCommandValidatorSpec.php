<?php

namespace spec\App\Commands\Validation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateSupplierCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Commands\Validation\UpdateSupplierCommandValidator');
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'name' => 'string|required',
            'attention' => 'string',
            'email' => 'email',
        ]);
    }
}
