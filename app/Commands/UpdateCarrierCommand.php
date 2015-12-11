<?php namespace App\Commands;

use App\Carrier;
use App\Repositories\CarrierRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateCarrierCommand extends Command implements SelfHandling {

    protected $id;
    protected $name;
    protected $is_default_carrier;

	/**
	 * Create a new command instance.
	 *
     * @param int $id
	 * @param string $name
     * @param bool $is_default_carrier
	 */
	public function __construct($id, $name, $is_default_carrier = false)
	{
        $this->id = $id;
		$this->name = $name;
        $this->is_default_carrier = (bool)$is_default_carrier;
	}

	/**
	 * Execute the command.
	 *
     * @param CarrierRepository $carriers
	 * @return Carrier
	 */
	public function handle(CarrierRepository $carriers)
	{
        if ($this->is_default_carrier) {
            try {
                $carrier = $carriers->findDefaultCarrier()->fill(['is_default_carrier' => false]);
                $carriers->save($carrier);
            }
            catch (ModelNotFoundException $e) {
            }
        }

		$carrier = $carriers->findById($this->id)->fill($this->getProperties());
        $carriers->save($carrier);
        return $carrier;
	}

}
