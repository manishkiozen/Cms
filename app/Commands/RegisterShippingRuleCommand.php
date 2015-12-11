<?php namespace App\Commands;

use App\Commands\Command;

use App\Repositories\ShippingRuleRepository;
use App\ShippingRule;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterShippingRuleCommand extends Command implements SelfHandling {

    protected $carrier_id;
    protected $country_id;

	/**
	 * Create a new command instance.
	 *
	 * @param int $carrier_id
     * @param int $country_id
	 */
	public function __construct($carrier_id, $country_id)
	{
		$this->carrier_id = $carrier_id;
        $this->country_id = $country_id;
	}

	/**
	 * Execute the command.
	 *
     * @param ShippingRuleRepository $rules
	 * @return ShippingRule
	 */
	public function handle(ShippingRuleRepository $rules)
	{
		$rule = ShippingRule::register($this->carrier_id, $this->country_id);
        $rules->save($rule);
        return $rule;
	}

}
