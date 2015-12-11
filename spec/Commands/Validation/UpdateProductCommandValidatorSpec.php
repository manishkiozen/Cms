<?php namespace spec\App\Commands\Validation;

use App\Commands\Validation\UpdateProductCommandValidator;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class UpdateProductCommandValidatorSpec extends LaravelObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateProductCommandValidator::class);
    }

    function it_returns_the_validation_rules()
    {
        $this->getRules()->shouldReturn([
            'description' => 'string|required',
            'detailed_description' => 'string',
            'ean' => '',

            'purchase_price' => 'numeric',
            'selling_price' => 'numeric',
            'recommended_retail_price' => 'numeric',

            'delivery_time' => 'integer',
        ]);
    }
}
