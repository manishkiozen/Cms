<?php namespace spec\App\Commands\Validation;

use App\Commands\Validation\RegisterProductCommandValidator;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class RegisterProductCommandValidatorSpec extends LaravelObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType(RegisterProductCommandValidator::class);
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'description' => 'string|required',
            'product_number' => 'string|required|unique:products',
            'product_type_id' => 'integer|required',
        ]);
    }

}
