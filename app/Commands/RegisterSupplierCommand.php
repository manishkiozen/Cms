<?php namespace App\Commands;

use App\Commands\Command;

use App\Repositories\SupplierRepository;
use App\Supplier;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterSupplierCommand extends Command implements SelfHandling {

    protected $name;

	/**
	 * Create a new command instance.
	 *
	 * @param string $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	 * Execute the command.
	 *
     * @param SupplierRepository $suppliers
	 * @return Supplier
	 */
	public function handle(SupplierRepository $suppliers)
	{
		$supplier = Supplier::register($this->name);
        $suppliers->save($supplier);
        return $supplier;
	}

}
