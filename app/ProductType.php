<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model {

    use SoftDeletes;

    protected $table = 'product_types';

    protected $fillable = [
        'description',
    ];

    /**
     * Returns the assigned attributes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    /**
     * Registers a new product type.
     *
     * @param string $description
     * @return static
     */
    public static function register($description)
    {
        return new static(compact('description'));
    }
}
