<?php namespace App\Commands;

use App\Attribute;
use App\AttributeValue;
use App\Commands\Command;

use App\Repositories\AttributeRepository;
use App\Repositories\AttributeValueRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateAttributeCommand extends Command implements SelfHandling {

    protected $id;
    protected $description;
    protected $unit_of_measurement;

    protected $add_value;

	/**
	 * Create a new command instance.
	 *
     * @param int $id
	 * @param string $description
     * @param string|null $unit_of_measurement
     * @param string|null $add_value
	 */
	public function __construct($id, $description, $unit_of_measurement = null, $add_value = null)
	{
        $this->id = $id;
		$this->description = $description;
        $this->unit_of_measurement = $unit_of_measurement;
        $this->add_value = $add_value;
	}

	/**
	 * Execute the command.
	 *
     * @param AttributeRepository $attributes
     * @param AttributeValueRepository $values
	 * @return Attribute
	 */
	public function handle(AttributeRepository $attributes, AttributeValueRepository $values)
	{
		$attribute = $attributes->findById($this->id)->fill($this->getProperties());
        $attributes->save($attribute);

        if ($this->add_value) {
            $value = AttributeValue::register($attribute->id, $this->add_value);
            $values->save($value);
        }

        return $attribute;
	}

}
