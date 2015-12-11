<?php

use App\Repositories\UserRepository;
use App\User;

trait UserTrait {

    protected $user_name = 'John Doe';
    protected $user_email = 'john@doe.com';
    protected $user_password = 'password';

    /**
     * Returns the user repository.
     *
     * @return UserRepository
     */
    public function users()
    {
        return new UserRepository();
    }

    /**
     * Returns the current user model
     *
     * @return User
     */
    public function currentUser()
    {
        return $this->users()->findByEmail($this->user_email);
    }

    /**
     * Visits the login page and submits the form with the given credentials.
     *
     * @param string $email
     * @param string $password
     */
    public function login($email, $password)
    {
        $this->visit(route('session.create'));
        $this->fillField('email', $email);
        $this->fillField('password', $password);
        $this->pressButton(trans('authentication.login'));
    }

    /**
     * Visits the logout page.
     */
    public function logout()
    {
        $this->visit(route('session.destroy'));
    }

}
