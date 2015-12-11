<?php namespace App\Commands;

use App\Country;
use App\Repositories\CountryRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterCountryCommand extends Command implements SelfHandling {

    protected $iso_code_2;
    protected $name;

	/**
	 * Create a new command instance.
	 *
     * @param string $iso_code_2
     * @param string $name
	 */
	public function __construct($iso_code_2, $name)
	{
		$this->iso_code_2 = $iso_code_2;
        $this->name = $name;
	}

	/**
	 * Execute the command.
	 *
     * @param CountryRepository $countries
	 * @return Country
	 */
	public function handle(CountryRepository $countries)
	{
		$country = Country::register($this->iso_code_2, $this->name);
        $countries->save($country);
        return $country;
	}

}
