<?php namespace App\Services;

use App\ShippingRule;
use InvalidArgumentException;
use App\Carrier;
use App\Country;
use App\Product;
use App\Repositories\CarrierRepository;
use App\Repositories\ShippingRuleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeliveryTimeCalculator
{
    protected $carriers;
    protected $rules;

    protected $carrier;
    protected $country;

    /**
     * Creates a delivery time calculator.
     *
     * @param ShippingRuleRepository $rules
     * @param CarrierRepository $carriers
     */
    public function __construct(ShippingRuleRepository $rules, CarrierRepository $carriers)
    {
        $this->rules = $rules;
        $this->carriers = $carriers;
    }

    /**
     * Set the preferred carrier.
     *
     * @param Carrier $carrier
     */
    public function setCarrier(Carrier $carrier)
    {
        $this->carrier = $carrier;
    }

    /**
     * Set the country that should be delivered to.
     *
     * @param Country $country
     * @throws InvalidArgumentException
     */
    public function setCountry(Country $country)
    {
        if ( ! $country->canBeShippedTo()) {
            throw new InvalidArgumentException(trans('countries.cannot_be_shipped_to', ['name' => $country->name]));
        }
        $this->country = $country;
    }

    /**
     * Returns the set or default carrier.
     *
     * @return Carrier
     * @throws ModelNotFoundException
     */
    protected function getCarrier()
    {
        return $this->carrier instanceof Carrier
            ? $this->carrier
            : $this->carriers->findDefaultCarrier();
    }

    /**
     * Finds the appropriate shipping rule.
     *
     * @return ShippingRule
     * @throws ModelNotFoundException
     */
    public function findShippingRule()
    {
        return $this->rules->findByCarrierIdAndCountryId($this->getCarrier()->id, $this->getCountry()->id, true);
    }

    /**
     * Calculates a delivery time in days.
     *
     * @param Product $product
     * @return int
     */
    public function calculate(Product $product)
    {
        return $this->findShippingRule()->delivery_time + $product->delivery_time;
    }

}
