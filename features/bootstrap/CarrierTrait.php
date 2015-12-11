<?php

use App\Carrier;
use App\Repositories\CarrierRepository;

trait CarrierTrait {

    protected $carrier_name = 'Acme Transport';

    protected $another_carrier_name = 'Trucks & Planes Inc';

    /**
     * Returns the carrier repository.
     *
     * @return CarrierRepository
     */
    protected function carriers()
    {
        return new CarrierRepository();
    }

    /**
     * Returns the current carrier.
     *
     * @return Carrier
     */
    protected function currentCarrier()
    {
        return current($this->carriers()->query($this->carrier_name)->items());
    }

    /**
     * Returns another carrier.
     *
     * @return Carrier
     */
    protected function anotherCarrier()
    {
        return current($this->carriers()->query($this->another_carrier_name)->items());
    }

}
