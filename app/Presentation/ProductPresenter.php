<?php namespace App\Presentation;

use App\Product;
use McCool\LaravelAutoPresenter\BasePresenter;

class ProductPresenter extends BasePresenter {

    protected $money;

    /**
     * Create a product presenter instance.
     *
     * @param Product $resource
     * @param Money $money
     */
    public function __construct(Product $resource, Money $money)
    {
        $this->wrappedObject = $resource;
        $this->money = $money;
    }

    /**
     * Formats the purchase price.
     *
     * @return string
     */
    public function purchase_price()
    {
        return $this->wrappedObject->purchase_price ? $this->money->format($this->wrappedObject->purchase_price) : '';
    }

    /**
     * Formats the selling price.
     *
     * @return string
     */
    public function selling_price()
    {
        return $this->wrappedObject->selling_price ? $this->money->format($this->wrappedObject->selling_price) : '';
    }

    /**
     * Formats the recommended retail price.
     *
     * @return string
     */
    public function recommended_retail_price()
    {
        return $this->wrappedObject->recommended_retail_price ? $this->money->format($this->wrappedObject->recommended_retail_price) : '';
    }

}
