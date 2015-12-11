<?php namespace App\Commands;

use App\Repositories\VatRateRepository;
use App\VatRate;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateVatRateCommand extends Command implements SelfHandling {

    protected $id;
    protected $description;
    protected $rate;

	/**
	 * Create a new command instance.
	 *
     * @param int $id
	 * @param string $description
     * @param float $rate
	 */
	public function __construct($id, $description, $rate)
	{
        $this->id = $id;
		$this->description = $description;
        $this->rate = $rate;
	}

	/**
	 * Execute the command.
	 *
     * @param VatRateRepository $vat_rates
	 * @return VatRate
	 */
	public function handle(VatRateRepository $vat_rates)
	{
        $vat_rate = $vat_rates->findById($this->id)->fill($this->getProperties());
        $vat_rates->save($vat_rate);
        return $vat_rate;
	}

}
