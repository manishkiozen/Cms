<?php namespace spec\App;

use App\User;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class UserSpec extends LaravelObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    function it_can_be_registered()
    {
        $user = User::register('John Doe', 'john@doe.com', 'password', 'admin');

        \PHPUnit_Framework_Assert::assertEquals('John Doe', $user->name);
        \PHPUnit_Framework_Assert::assertEquals('john@doe.com', $user->email);
        \PHPUnit_Framework_Assert::assertEquals('password', $user->password);
        \PHPUnit_Framework_Assert::assertEquals('admin', $user->role);
    }

    function it_has_a_user_role_by_default()
    {
        $user = User::register('John Doe', 'john@doe.com', 'password');

        \PHPUnit_Framework_Assert::assertEquals('user', $user->role);
    }

    function it_soft_deletes()
    {
        $this->getDeletedAtColumn()->shouldReturn('deleted_at');
    }

}
