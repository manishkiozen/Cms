<?php

use App\Repositories\SupplierRepository;
use App\Supplier;

trait SupplierTrait {

    protected $supplier_name = 'Acme Logistics';
    protected $supplier_attention = 'John Doe';
    protected $supplier_email = 'orders@acme-logistics.com';

    /**
     * Returns the supplier repository.
     *
     * @return SupplierRepository
     */
    public function suppliers()
    {
        return new SupplierRepository();
    }

    /**
     * Returns the current supplier.
     *
     * @return Supplier
     */
    public function currentSupplier()
    {
        return current($this->suppliers()->query($this->supplier_name)->items());
    }

}
