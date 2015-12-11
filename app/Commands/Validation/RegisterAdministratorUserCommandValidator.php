<?php namespace App\Commands\Validation;

class RegisterAdministratorUserCommandValidator extends CommandValidator {

    protected $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required',
    ];

}
