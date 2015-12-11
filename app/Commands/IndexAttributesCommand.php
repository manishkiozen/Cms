<?php namespace App\Commands;

use App\Commands\Command;

use App\Repositories\AttributeRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Pagination\Paginator;

class IndexAttributesCommand extends Command implements SelfHandling {

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
     * @param AttributeRepository $attributes
	 * @return Paginator
	 */
	public function handle(AttributeRepository $attributes)
	{
		return $attributes->query($this->q);
	}

}
