<?php

namespace spec\App\Commands\Validation;

use App\Commands\Validation\RegisterAdministratorUserCommandValidator;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class RegisterAdministratorUserCommandValidatorSpec extends LaravelObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType(RegisterAdministratorUserCommandValidator::class);
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);
    }

}
