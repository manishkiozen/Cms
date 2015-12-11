<?php namespace App\Commands;

use App\Events\UserWasLoggedOut;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\SelfHandling;

class LogoutCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
	}

	/**
	 * Execute the command.
	 *
     * @param Guard $guard
	 * @return void
	 */
	public function handle(Guard $guard)
	{
        $user = $guard->user();
		$guard->logout();
        event(new UserWasLoggedOut($user));
	}

}
