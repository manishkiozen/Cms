<?php

use App\ProductType;
use App\Repositories\ProductTypeRepository;

trait ProductTypeTrait {

    protected $product_type_description = 'Book';

    /**
     * Returns the product type repository.
     *
     * @return ProductTypeRepository
     */
    public function productTypes()
    {
        return new ProductTypeRepository();
    }

    /**
     * Returns the current product type.
     *
     * @return ProductType
     */
    public function currentProductType()
    {
        return current($this->productTypes()->query($this->product_type_description)->all());
    }

}
