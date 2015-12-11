<?php

use App\Repositories\ShippingRuleRepository;
use App\ShippingRule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ShippingRuleTrait {

    protected $shipping_rule_delivery_time = 3;

    /**
     * Returns the shipping rule repository.
     *
     * @return ShippingRuleRepository
     */
    protected function shippingRules()
    {
        return new ShippingRuleRepository();
    }

    /**
     * Returns the current shipping rule.
     *
     * @return ShippingRule
     * @throws ModelNotFoundException
     */
    protected function currentShippingRule()
    {
        $carrier = $this->currentCarrier();
        $country = $this->currentCountry();
        return $this->shippingRules()->findByCarrierIdAndCountryId($carrier->id, $country->id);
    }

}