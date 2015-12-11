<?php namespace App\Commands;

use App\Commands\Command;

use App\Repositories\SupplierRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Pagination\Paginator;

class IndexSuppliersCommand extends Command implements SelfHandling {

    protected $q;

	/**
	 * Create a new command instance.
	 *
	 * @param string|null $q
	 */
	public function __construct($q = null)
	{
		$this->q = $q;
	}

	/**
	 * Execute the command.
	 *
     * @param SupplierRepository $suppliers
	 * @return Paginator
	 */
	public function handle(SupplierRepository $suppliers)
	{
		return $suppliers->query($this->q);
	}

}
