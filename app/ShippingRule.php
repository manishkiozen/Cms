<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingRule extends Model {

	protected $table = 'shipping_rules';

    protected $fillable = [
        'carrier_id',
        'country_id',
        'is_enabled',
        'delivery_time',
    ];

    /**
     * Returns the related carrier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    /**
     * Returns the related country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Registers a new shipping rule.
     *
     * @param int $carrier_id
     * @param int $country_id
     * @return static
     */
    public static function register($carrier_id, $country_id)
    {
        return new static(compact('carrier_id', 'country_id'));
    }

}
