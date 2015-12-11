<?php namespace App\Commands;

use App\Repositories\CountryRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Pagination\Paginator;

class IndexCountriesCommand extends Command implements SelfHandling {

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
     * @param CountryRepository $countries
     * @return Paginator
     */
	public function handle(CountryRepository $countries)
	{
		return $countries->query($this->query);
	}

}
