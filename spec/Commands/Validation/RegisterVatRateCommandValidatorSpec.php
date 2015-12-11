<?php namespace spec\App\Commands\Validation;

use App\Commands\Validation\RegisterVatRateCommandValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegisterVatRateCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RegisterVatRateCommandValidator::class);
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'description' => 'required|string',
            'rate' => 'required|numeric',
        ]);
    }

}
