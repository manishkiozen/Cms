<?php

use App\Country;
use App\Repositories\CountryRepository;

trait CountryTrait {

    protected $country_iso_code_2 = 'NL';
    protected $country_name = 'Netherlands, the';
    protected $country_is_area_of_sales = true;

    /**
     * Returns the country repository.
     *
     * @return CountryRepository
     */
    public function countries()
    {
        return new CountryRepository();
    }

    /**
     * Returns the current country.
     *
     * @return Country
     */
    public function currentCountry()
    {
        return $this->countries()->findByIsoCode2($this->country_iso_code_2);
    }
}