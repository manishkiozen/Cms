<?php namespace App\Commands;

use App\Commands\Command;

use App\Repositories\ShippingRuleRepository;
use App\ShippingRule;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateShippingRuleCommand extends Command implements SelfHandling {

    protected $id;
    protected $is_enabled;
    protected $delivery_time;

	/**
	 * Create a new command instance.
	 *
	 * @param int $id
     * @param bool $is_enabled
     * @param int $delivery_time
	 */
	public function __construct($id, $is_enabled = false, $delivery_time)
	{
		$this->id = $id;
        $this->is_enabled = (bool)$is_enabled;
        $this->delivery_time = $delivery_time;
	}

	/**
	 * Execute the command.
	 *
     * @param ShippingRuleRepository $rules
	 * @return ShippingRule
	 */
	public function handle(ShippingRuleRepository $rules)
	{
		$rule = $rules->findById($this->id)->fill($this->getProperties());
        $rules->save($rule);
        return $rule;
	}

}
