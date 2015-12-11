<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    protected $table = 'attributes';

    protected $fillable = [
        'description',
        'type',
        'unit_of_measurement',
    ];

    /**
     * Returns the attached attribute values.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    /**
     * Registers a new attribute.
     *
     * @param string $description
     * @param string $type
     * @return Attribute
     */
    public static function register($description, $type)
    {
        return new static(compact('description', 'type'));
    }

    /**
     * Returns an array with allowed attribute types following the Laravel validation rules.
     * string: a textual value
     * numeric: a numeric value
     * in: a value from a fixed value list
     *
     * @return array
     */
    public static function getAllowedTypes()
    {
        return [
            'string',
            'numeric',
            'in',
        ];
    }

    /**
     * Indicates if the attribute supports values.asdf
     *
     * @return bool
     */
    public function supportsValues()
    {
        return $this->type == 'in';
    }

}
