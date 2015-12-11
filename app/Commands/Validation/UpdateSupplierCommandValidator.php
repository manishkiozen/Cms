<?php namespace App\Commands\Validation;

class UpdateSupplierCommandValidator extends CommandValidator
{

    protected $rules = [
        'name' => 'string|required',
        'attention' => 'string',
        'email' => 'email',
    ];

}
