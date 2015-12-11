<?php namespace App\Commands\Validation;

class UpdateProductCommandValidator extends CommandValidator {

    protected $rules = [
        'description' => 'string|required',
        'detailed_description' => 'string',
        'ean' => '',

        'purchase_price' => 'numeric',
        'selling_price' => 'numeric',
        'recommended_retail_price' => 'numeric',

        'delivery_time' => 'integer',
    ];

}
