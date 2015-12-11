<?php namespace App\Commands\Validation;

class UpdateCarrierCommandValidator extends CommandValidator {

    protected $rules = [
        'name' => 'string|required',
        'is_default_carrier' => 'boolean',
    ];

}
