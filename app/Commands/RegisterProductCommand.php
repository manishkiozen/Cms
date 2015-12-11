<?php namespace App\Commands;

use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterProductCommand extends Command implements SelfHandling {

    protected $product_type_id;
    protected $product_number;
    protected $description;

	/**
	 * Create a new command instance.
     *
     * @param string $product_number
     * @param string $description
     * @param int $product_type_id
     */
	public function __construct($product_number, $description, $product_type_id)
	{
        $this->product_type_id = $product_type_id;
        $this->product_number = $product_number;
		$this->description = $description;
	}

	/**
	 * Execute the command.
	 *
     * @param ProductRepository $products
	 * @return Product
	 */
	public function handle(ProductRepository $products)
	{
        $product = Product::register($this->product_number, $this->description, $this->product_type_id);
        $products->save($product);
        return $product;
	}

}
