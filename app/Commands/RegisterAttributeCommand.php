<?php namespace App\Commands;

use App\Attribute;
use App\Commands\Command;

use App\Repositories\AttributeRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterAttributeCommand extends Command implements SelfHandling {

    protected $description;
    protected $type;

	/**
	 * Create a new command instance.
	 *
	 * @param string $description
     * @param string $type
	 */
	public function __construct($description, $type)
	{
		$this->description = $description;
        $this->type = $type;
	}

	/**
	 * Execute the command.
	 *
     * @param AttributeRepository $attributes
	 * @return Attribute
	 */
	public function handle(AttributeRepository $attributes)
	{
        $attribute = Attribute::register($this->description, $this->type);
		$attributes->save($attribute);
        return $attribute;
	}

}
