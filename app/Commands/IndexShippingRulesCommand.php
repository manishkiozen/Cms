<?php namespace App\Commands;

use App\Commands\Command;

use App\Repositories\ShippingRuleRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class IndexShippingRulesCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle(ShippingRuleRepository $rules)
	{
		return $rules->all();
	}

}
