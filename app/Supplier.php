<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {

	protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'attention',
        'email',
    ];

    /**
     * Registers a new supplier.
     *
     * @param string $name
     * @return static
     */
    public static function register($name)
    {
        return new static(compact('name'));
    }
}
