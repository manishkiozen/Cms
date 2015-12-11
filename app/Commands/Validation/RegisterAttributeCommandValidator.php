<?php namespace App\Commands\Validation;

use App\Attribute;

class RegisterAttributeCommandValidator extends CommandValidator {

    protected $rules = [
        'description' => 'required|string',
        'type' => 'required',
    ];

    public function __construct()
    {
        $this->rules['type'] .= '|in:' . implode(',', Attribute::getAllowedTypes());
    }

}
