<?php namespace App\Console\Commands;

use App\Commands\RegisterAdministratorUserCommand;
use App\Exceptions\UserAlreadyExistsException;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RegisterAdministrator extends Command {

    use DispatchesCommands;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:register';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Registers a new administrator account.';

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        try {
            $user = $this->dispatch(new RegisterAdministratorUserCommand(
                    $this->argument('name'),
                    $this->argument('email'),
                    $this->argument('password')));

            $this->info('Administrator user registered: ' . $user->email);
        }
        catch (UserAlreadyExistsException $e) {
            $this->error('User already exists: ' . $e->getMessage());
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['name', InputArgument::REQUIRED, 'The (real) name of the user.'],
            ['email', InputArgument::REQUIRED, 'The e-mail address used for logging in.'],
            ['password', InputArgument::REQUIRED, 'The password used for logging in.']
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			//['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
