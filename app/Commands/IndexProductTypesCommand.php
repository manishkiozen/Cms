<?php namespace App\Commands;

use App\Commands\Command;

use App\Repositories\ProductTypeRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Database\Eloquent\Collection;

class IndexProductTypesCommand extends Command implements SelfHandling {

    protected $q;

	/**
	 * Create a new command instance.
	 *
	 * @param string|null $q
	 */
	public function __construct($q = null)
	{
		$this->q = $q;
	}

	/**
	 * Execute the command.
	 *
     * @param ProductTypeRepository $types
     * @return Collection
     */
	public function handle(ProductTypeRepository $types)
	{
		return $types->query($this->q);
	}

}
