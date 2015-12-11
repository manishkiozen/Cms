<?php

use App\Product;
use App\Repositories\ProductRepository;

trait ProductTrait {

    protected $product_number = '123456';
    protected $product_description = 'The best product in the world';
    protected $product_detailed_description = 'It now has an extended description too!';
    protected $product_ean = '9789058556851';
    protected $product_delivery_time = 3;
    protected $product_purchase_price = 1.66;
    protected $product_selling_price = 4.98;
    protected $product_recommended_retail_price = 5.99;

    /**
     * Returns the product repository.
     *
     * @return ProductRepository
     */
    public function products()
    {
        return new ProductRepository();
    }

    /**
     * Returns the current product.
     *
     * @return Product
     */
    public function currentProduct()
    {
        return $this->products()->findByProductNumber($this->product_number);
    }
}
