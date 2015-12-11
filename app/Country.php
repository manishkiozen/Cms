<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    protected $table = 'countries';

    protected $fillable = [
        'iso_code_2',
        'name',
        'is_area_of_sales',
    ];

    /**
     * Registers a new country.
     *
     * @param string $iso_code_2
     * @param string $name
     * @return Country
     */
	public static function register($iso_code_2, $name)
    {
        return new static(compact('iso_code_2', 'name'));
    }

    /**
     * Indicates if the country can be shipped to.
     *
     * @return bool
     */
    public function canBeShippedTo()
    {
        return (bool)$this->is_area_of_sales;
    }

}
