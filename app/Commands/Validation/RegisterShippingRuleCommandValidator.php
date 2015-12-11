<?php namespace App\Commands\Validation;

class RegisterShippingRuleCommandValidator extends CommandValidator {

    protected $rules = [
        'carrier_id' => 'exists:carriers,id',
        'country_id' => 'exists:countries,id',
    ];

}
