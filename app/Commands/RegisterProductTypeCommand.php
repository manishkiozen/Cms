<?php namespace App\Commands;

use App\ProductType;
use App\Repositories\ProductTypeRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterProductTypeCommand extends Command implements SelfHandling {

    protected $description;

	/**
	 * Create a new command instance.
	 *
	 * @param string $description
	 */
	public function __construct($description)
	{
		$this->description = $description;
	}

	/**
	 * Execute the command.
	 *
     * @param ProductTypeRepository $types
     * @return ProductType
     */
	public function handle(ProductTypeRepository $types)
	{
		$type = ProductType::register($this->description);
        $types->save($type);
        return $type;
	}

}
