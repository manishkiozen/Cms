<?php namespace App\Commands;

use App\Repositories\CountryRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateCountryCommand extends Command implements SelfHandling {

    protected $id;
    protected $iso_code_2;
    protected $name;
    protected $is_area_of_sales;

    /**
     * Create a new command instance.
     *
     * @param int $id
     * @param string $iso_code_2
     * @param string $name
     * @param bool $is_area_of_sales
     */
    public function __construct($id, $iso_code_2, $name, $is_area_of_sales = false)
    {
        $this->id = $id;
        $this->iso_code_2 = $iso_code_2;
        $this->name = $name;
        $this->is_area_of_sales = (bool)$is_area_of_sales;
    }

	/**
	 * Execute the command.
	 *
     * @param CountryRepository $countries
	 * @return Country
	 */
	public function handle(CountryRepository $countries)
	{
		$country = $countries->findById($this->id)->fill($this->getProperties());
        $countries->save($country);
        return $country;
	}

}
