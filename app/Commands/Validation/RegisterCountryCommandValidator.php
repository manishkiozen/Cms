<?php namespace App\Commands\Validation;

class RegisterCountryCommandValidator extends CommandValidator {

    protected $rules = [
        'iso_code_2' => 'required|string|size:2',
        'name' => 'required|string',
    ];

}
