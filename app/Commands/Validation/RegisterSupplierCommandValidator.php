<?php namespace App\Commands\Validation;

class RegisterSupplierCommandValidator extends CommandValidator
{

    protected $rules = [
        'name' => 'string|required',
    ];

}
