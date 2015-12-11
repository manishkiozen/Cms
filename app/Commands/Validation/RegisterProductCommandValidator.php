<?php namespace App\Commands\Validation;

class RegisterProductCommandValidator extends CommandValidator {

    protected $rules = [
        'description' => 'string|required',
        'product_number' => 'string|required|unique:products',
        'product_type_id' => 'integer|required',
    ];

}
