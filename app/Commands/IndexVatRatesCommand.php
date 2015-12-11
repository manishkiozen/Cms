<?php namespace App\Commands;

use App\Repositories\VatRateRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Pagination\Paginator;

class IndexVatRatesCommand extends Command implements SelfHandling {

    protected $query;

	/**
	 * Create a new command instance.
	 *
	 * @param string|null $q
	 */
	public function __construct($q = null)
	{
		$this->query = $q;
	}

	/**
	 * Execute the command.
	 *
     * @param VatRateRepository $vat_rates
     * @return Paginator
     */
	public function handle(VatRateRepository $vat_rates)
	{
		return $vat_rates->query($this->query);
	}

}
