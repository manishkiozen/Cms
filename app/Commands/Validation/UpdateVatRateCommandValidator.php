<?php namespace App\Commands\Validation;

class UpdateVatRateCommandValidator extends CommandValidator {

    protected $rules = [
        'description' => 'required|string',
        'rate' => 'required|numeric',
    ];

}
