<?php namespace App\Commands;

use App\ProductType;
use App\Repositories\ProductTypeRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateProductTypeCommand extends Command implements SelfHandling {

    protected $attributes;
    protected $description;
    protected $id;

	/**
	 * Create a new command instance.
	 *
     * @param int $id
	 * @param string $description
     * @param array $attributes
	 */
	public function __construct($id, $description, array $attributes = [])
	{
        $this->id = $id;
		$this->description = $description;
        $this->attributes = $attributes;
	}

	/**
	 * Execute the command.
	 *
     * @param ProductTypeRepository $types
	 * @return ProductType
	 */
	public function handle(ProductTypeRepository $types)
	{
		$type = $types->findById($this->id)->fill($this->getProperties());
        $types->save($type);

        $type->attributes()->sync($this->attributes);

        return $type;
	}

}
