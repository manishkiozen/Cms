<?php namespace spec\App\Commands\Validation;

use App\Commands\Validation\UpdateCountryCommandValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateCountryCommandValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateCountryCommandValidator::class);
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'iso_code_2' => 'required|string|size:2',
            'name' => 'required|string',
        ]);
    }

}
