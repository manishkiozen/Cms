<?php

use App\Repositories\VatRateRepository;
use App\VatRate;

trait VatRateTrait {

    protected $vat_description = 'High';
    protected $vat_rate = 21;

    protected $vat_updated_description = 'Updated description';

    /**
     * @return VatRateRepository
     */
    public function vatRates()
    {
        return new VatRateRepository();
    }

    /**
     * Returns the current VAT rate.
     *
     * @return VatRate
     */
    public function currentVatRate()
    {
        return current($this->vatRates()->query($this->vat_description)->items());
    }

    /**
     * Returns the updated VAT rate.
     *
     * @return VatRate
     */
    public function updatedVatRate()
    {
        return current($this->vatRates()->query($this->vat_updated_description)->items());
    }

}
