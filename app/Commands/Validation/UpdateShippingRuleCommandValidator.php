<?php namespace App\Commands\Validation;

class UpdateShippingRuleCommandValidator extends CommandValidator {

    protected $rules = [
        'is_enabled' => 'boolean',
        'delivery_time' => 'integer|required|min:1',
    ];

}
