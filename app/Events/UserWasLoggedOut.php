<?php namespace App\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

class UserWasLoggedOut extends Event {

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
     * Returns the logged out user.
     *
     * @return Authenticatable
     */
    public function getUser()
    {
        return $this->user;
    }

}
