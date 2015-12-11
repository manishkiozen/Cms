<?php namespace App\Commands;

use App\Repositories\CarrierRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Pagination\Paginator;

class IndexCarriersCommand extends Command implements SelfHandling {

    protected $q;

	/**
	 * Create a new command instance.
	 *
	 * @param string|null $q
	 */
	public function __construct($q = null)
	{
		$this->q = $q;
	}

	/**
	 * Execute the command.
	 *
     * @param CarrierRepository $carriers
     * @return Paginator
     */
	public function handle(CarrierRepository $carriers)
	{
		return $carriers->query($this->q);
	}

}
