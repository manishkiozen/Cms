<?php namespace App\Commands;

use App\Commands\Command;

use App\Repositories\SupplierRepository;
use App\Supplier;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateSupplierCommand extends Command implements SelfHandling {

    protected $id;
    protected $name;
    protected $attention;
    protected $email;

	/**
	 * Create a new command instance.
	 *
     * @param int $id
     * @param string $name
     * @param string|null $attention
     * @param string|null $email
     */
	public function __construct($id, $name, $attention = null, $email = null)
	{
        $this->id = $id;
		$this->name = $name;
        $this->attention = $attention;
        $this->email = $email;
	}

	/**
	 * Execute the command.
	 *
     * @param SupplierRepository $suppliers
	 * @return Supplier
	 */
	public function handle(SupplierRepository $suppliers)
	{
		$supplier = $suppliers->findById($this->id)->fill($this->getProperties());
        $suppliers->save($supplier);
        return $supplier;
	}

}
