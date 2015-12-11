<?php namespace App\Repositories;

use App\ShippingRule;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShippingRuleRepository extends EloquentRepository {

    /**
     * Finds a shipping rule by id.
     *
     * @param int $id
     * @return ShippingRule
     * @throws ModelNotFoundException
     */
    public function findById($id)
    {
        return ShippingRule::findOrFail($id);
    }

    /**
     * Finds a shipping rule by carrier id and country id.
     *
     * @param int $carrier_id
     * @param int $country_id
     * @param bool|null $is_enabled
     * @return ShippingRule
     * @throws ModelNotFoundException
     */
    public function findByCarrierIdAndCountryId($carrier_id, $country_id, $is_enabled = null)
    {
        return ShippingRule::where('carrier_id', '=', $carrier_id)
            ->where('country_id', '=', $country_id)
            ->where(function ($query) use ($is_enabled) {
                if ( ! is_null($is_enabled)) {
                    $query->where('is_enabled', '=', $is_enabled);
                }
            })
            ->firstOrFail();
    }

    /**
     * Returns a collection with shipping rules.
     *
     * @return Collection
     */
    public function all()
    {
        return ShippingRule::with('carrier', 'country')
            ->join('carriers', 'carriers.id', '=', 'shipping_rules.carrier_id')
            ->join('countries', 'countries.id', '=', 'shipping_rules.country_id')
            ->orderBy('carriers.name')
            ->orderBy('countries.name')
            ->select('shipping_rules.*')
            ->get();
    }

}
