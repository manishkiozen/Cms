<?php namespace App\Commands\Validation;

abstract class CommandValidator {

    protected $rules;

    /**
     * Returns an array with validation rules.
     *
     * @return array
     */
    public function getRules()
    {
        return is_array($this->rules) ? $this->rules : [];
    }

}
