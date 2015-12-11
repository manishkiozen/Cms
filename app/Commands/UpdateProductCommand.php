<?php namespace App\Commands;

use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateProductCommand extends Command implements SelfHandling {

    protected $id;

    protected $description;
    protected $detailed_description;
    protected $ean;

    protected $can_be_purchased;
    protected $supplier_id;
    protected $delivery_time;
    protected $purchase_price;

    protected $can_be_sold;
    protected $vat_rate_id;
    protected $selling_price;
    protected $recommended_retail_price;

    protected $attributes;

    /**
     * Create a new command instance.
     *
     * @param int $id
     * @param string $description
     * @param string $detailed_description
     * @param string $ean
     * @param bool|false $can_be_purchased
     * @param int|null $supplier_id
     * @param int|null $delivery_time
     * @param float|null $purchase_price
     * @param bool|false $can_be_sold
     * @param int $vat_rate_id
     * @param float|null $selling_price
     * @param float|null $recommended_retail_price
     * @param array $attributes
     */
    public function __construct($id, $description, $detailed_description, $ean,
                                $can_be_purchased = false, $supplier_id = null, $delivery_time = null, $purchase_price = null,
                                $can_be_sold = false, $vat_rate_id, $selling_price = null, $recommended_retail_price = null,
                                array $attributes = [])
    {
        $this->id = $id;
        $this->description = $description;
        $this->detailed_description = $detailed_description;
        $this->ean = $ean;

        $this->can_be_purchased = $can_be_purchased;
        $this->supplier_id = $supplier_id;
        $this->delivery_time = $delivery_time;
        $this->purchase_price = $purchase_price;

        $this->can_be_sold = $can_be_sold;
        $this->vat_rate_id = $vat_rate_id;
        $this->selling_price = $selling_price;
        $this->recommended_retail_price = $recommended_retail_price;

        $this->attributes = $attributes;
    }

	/**
	 * Execute the command.
	 *
     * @param ProductRepository $products
	 * @return Product
	 */
	public function handle(ProductRepository $products)
	{
		$product = $products->findById($this->id)->fill($this->getProperties());
        $products->save($product);

        $this->saveAttributes($product);

        return $product;
	}

    /**
     * Creates, updates or deletes the attributes.
     *
     * @param Product $product
     */
    protected function saveAttributes(Product $product)
    {
        $ids = [];
        foreach (array_filter($this->attributes) as $attribute_id => $value) {
            $ids[$attribute_id] = compact('value');
        }
        $product->attributes()->sync($ids);
    }

}
