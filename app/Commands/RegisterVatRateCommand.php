<?php namespace App\Commands;

use App\Repositories\VatRateRepository;
use App\VatRate;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterVatRateCommand extends Command implements SelfHandling {

    protected $description;
    protected $rate;

	/**
	 * Create a new command instance.
	 *
	 * @param string $description
     * @param float $rate
	 */
	public function __construct($description, $rate)
	{
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
		$vat_rate = VatRate::register($this->description, $this->rate);
        $vat_rates->save($vat_rate);
        return $vat_rate;
	}

}
