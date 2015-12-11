<?php namespace App\Commands\Validation;

class UpdateProductTypeCommandValidator extends CommandValidator {

    protected $rules = [
        'description' => 'required|string',
    ];

}
