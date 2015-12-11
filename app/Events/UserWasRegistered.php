<?php namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

class UserWasRegistered extends Event {

	use SerializesModels;

    protected $user;

	/**
	 * Create a new event instance.
	 *
     * @param User $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

    /**
     * Returns the registered user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

}
