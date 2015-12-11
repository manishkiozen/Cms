<?php

use App\Attribute;
use App\Repositories\AttributeRepository;

trait AttributeTrait {

    protected $attribute_description = 'Length';
    protected $attribute_type = 'numeric';
    protected $attribute_unit_of_measurement = 'cm';

    protected $attribute_value = 100;

    protected $attribute_list_of_values_description = 'Color';
    protected $attribute_list_of_values = [
        'Blue',
        'Green',
        'Red',
    ];

    /**
     * Returns the attribute repository.
     *
     * @return AttributeRepository
     */
    public function attributes()
    {
        return new AttributeRepository();
    }

    /**
     * Returns the current attribute.
     *
     * @return Attribute
     */
    public function currentAttribute()
    {
        return current($this->attributes()->query($this->attribute_description)->items());
    }

    /**
     * Returns the current attribute with a list of values.
     *
     * @return Attribute
     */
    public function currentListOfValuesAttribute()
    {
        return current($this->attributes()->query($this->attribute_list_of_values_description)->items());
    }

}
