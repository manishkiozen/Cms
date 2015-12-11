<?php namespace App\Commands;

class CommandTranslator {

    /**
     * Translates the command class to it's validator.
     *
     * @param Command $command
     * @return string
     */
    public function toValidator(Command $command)
    {
        $basename = class_basename($command);
        $namespace = str_replace($basename, '', get_class($command));
        return rtrim($namespace, '\\') . '\\Validation\\' . $basename . 'Validator';
    }

}
