<?php namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends EloquentRepository {

    /**
     * Finds a user by e-mail address.
     *
     * @param string $email
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByEmail($email)
    {
        return User::where('email', '=', $email)->firstOrFail();
    }

}
