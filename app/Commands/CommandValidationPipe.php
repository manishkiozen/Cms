<?php namespace App\Commands;

use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Validation\Factory;

class CommandValidationPipe {

    protected $translator;
    protected $validator;

    /**
     * @param CommandTranslator $translator
     * @param Factory $validator
     */
    public function __construct(CommandTranslator $translator, Factory $validator)
    {
        $this->translator = $translator;
        $this->validator = $validator;
    }

    /**
     * @param Command $command
     * @param callable $next
     * @return mixed
     */
    public function handle(Command $command, \Closure $next)
    {
        $class_name = $this->translator->toValidator($command);

        if (class_exists($class_name)) {
            $command_validator = new $class_name;
            $validation = $this->validator->make($command->getProperties(), $command_validator->getRules());
            if ($validation->fails()) {
                throw new ValidationException($validation);
            }
        }

        return $next($command);
    }

}