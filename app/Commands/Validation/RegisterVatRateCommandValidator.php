<?php namespace App\Commands\Validation;

class RegisterVatRateCommandValidator extends CommandValidator {

    protected $rules = [
        'description' => 'required|string',
        'rate' => 'required|numeric',
    ];

}
