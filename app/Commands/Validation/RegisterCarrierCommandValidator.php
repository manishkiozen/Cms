<?php namespace App\Commands\Validation;

class RegisterCarrierCommandValidator extends CommandValidator {

    protected $rules = [
        'name' => 'string|required',
    ];

}
