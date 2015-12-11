<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrier extends Model {

    use SoftDeletes;

    protected $table = 'carriers';

    protected $fillable =[
        'name',
        'is_default_carrier',
    ];

    /**
     * Registers a new carrier.
     *
     * @param string $name
     * @return static
     */
    public static function register($name)
    {
        return new static(compact('name'));
    }
}
