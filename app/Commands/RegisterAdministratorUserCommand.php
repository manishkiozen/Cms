<?php namespace App\Commands;

use App\Events\UserWasRegistered;
use App\Exceptions\UserAlreadyExistsException;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegisterAdministratorUserCommand extends Command implements SelfHandling {

    protected $email;
    protected $name;
    protected $password;

	/**
	 * Create a new command instance.
	 *
     * @param string $name
     * @param string $email
     * @param string $password
	 */
	public function __construct($name, $email, $password)
	{
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
	}

	/**
	 * Execute the command.
	 *
     * @param Hasher $hasher
     * @param UserRepository $users
	 * @return User
     * @throws UserAlreadyExistsException
	 */
	public function handle(Hasher $hasher, UserRepository $users)
	{
        try {
            $users->findByEmail($this->email);
            throw new UserAlreadyExistsException($this->email);
        }
        catch (ModelNotFoundException $e) {
            $user = User::register($this->name, $this->email, $hasher->make($this->password), 'admin');
            $users->save($user);

            event(new UserWasRegistered($user));
            return $user;
        }
	}

}
