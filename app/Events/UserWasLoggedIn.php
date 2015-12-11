<?php namespace App\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

class UserWasLoggedIn extends Event {

	use SerializesModels;

    protected $user;

	/**
	 * Create a new event instance.
	 *
	 * @param Authenticatable $user
	 */
	public function __construct(Authenticatable $user)
	{
		$this->user = $user;
	}

    /**
     * Returns the logged in user.
     *
     * @return Authenticatable
     */
    public function getUser()
    {
        return $this->getUser();
    }

}
