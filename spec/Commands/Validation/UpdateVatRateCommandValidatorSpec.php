<?php namespace spec\App\Commands\Validation;

use App\Commands\Validation\UpdateVatRateCommandValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateVatRateCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateVatRateCommandValidator::class);
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'description' => 'required|string',
            'rate' => 'required|numeric',
        ]);
    }

}
