<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model {

	protected $table = 'attribute_values';

    protected $fillable = [
        'attribute_id',
        'value',
    ];

    /**
     * Registers a new attribute value.
     *
     * @param int $attribute_id
     * @param mixed $value
     * @return static
     */
    public static function register($attribute_id, $value)
    {
        return new static(compact('attribute_id', 'value'));
    }

}
