<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VatRate extends Model {

    use SoftDeletes;

    protected $table = 'vat_rates';

    protected $fillable = [
        'description',
        'rate'
    ];

    /**
     * Registers a new VAT rate.
     *
     * @param string $description
     * @param float $rate
     * @return VatRate
     */
    public static function register($description, $rate)
    {
        return new static(compact('description', 'rate'));
    }

}
