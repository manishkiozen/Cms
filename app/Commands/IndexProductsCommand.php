<?php namespace App\Commands;

use App\Repositories\ProductRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Pagination\Paginator;

class IndexProductsCommand extends Command implements SelfHandling {

    protected $query;

	/**
	 * Create a new command instance.
     *
     * @param string|null $query
	 */
	public function __construct($query = null)
	{
		$this->query = $query;
	}

	/**
	 * Execute the command.
	 *
     * @param ProductRepository $products
	 * @return Paginator
	 */
	public function handle(ProductRepository $products)
	{
		return $products->query($this->query);
	}

}
