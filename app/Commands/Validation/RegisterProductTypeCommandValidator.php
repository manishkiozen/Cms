<?php namespace App\Commands\Validation;

class RegisterProductTypeCommandValidator extends CommandValidator {

    protected $rules = [
        'description' => 'required|string|unique:product_types',
    ];

}
