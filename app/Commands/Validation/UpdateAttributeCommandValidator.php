<?php namespace App\Commands\Validation;

class UpdateAttributeCommandValidator extends CommandValidator {

    protected $rules = [
        'description' => 'required|string',
        'unit_of_measurement' => 'string',
    ];

}
