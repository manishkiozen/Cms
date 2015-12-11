<?php namespace App\Commands;

use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class TrashProductCommand extends Command implements SelfHandling {

    protected $id;

	/**
	 * Create a new command instance.
	 *
	 * @param int $id
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * Execute the command.
	 *
     * @param ProductRepository $products
	 * @return Product
	 */
	public function handle(ProductRepository $products)
	{
		$product = $products->findById($this->id);
        $products->destroy($product);
        return $product;
	}

}
