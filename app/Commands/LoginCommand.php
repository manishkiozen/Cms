<?php namespace App\Commands;

use App\Exceptions\LoginFailedException;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\SelfHandling;

class LoginCommand extends Command implements SelfHandling {

    protected $email;
    protected $password;
    protected $remember;

    /**
     * Create a new command instance.
     *
     * @param string $email
     * @param string $password
     * @param bool $remember
     */
    public function __construct($email, $password, $remember = false)
    {
        $this->email = $email;
        $this->password = $password;
        $this->remember = (bool)$remember;
    }

	/**
	 * Execute the command.
     *
     * @param Guard $guard
     * @throws LoginFailedException
	 */
	public function handle(Guard $guard)
	{
        if ( ! $guard->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw new LoginFailedException($this->email);
        }
	}

}
