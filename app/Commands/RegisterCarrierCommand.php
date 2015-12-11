<?php namespace App\Commands;

use App\Carrier;
use App\Repositories\CarrierRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegisterCarrierCommand extends Command implements SelfHandling {

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
     * @param CarrierRepository $carriers
	 * @return Carrier
	 */
	public function handle(CarrierRepository $carriers)
	{
		$carrier = Carrier::register($this->name);

        try {
            $carriers->findDefaultCarrier();
        }
        catch (ModelNotFoundException $e) {
            $carrier->is_default_carrier = true;
        }

        $carriers->save($carrier);
        return $carrier;
	}

}
