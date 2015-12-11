<?php

namespace spec\App\Commands;

use App\Commands\Command;
use App\Commands\CommandTranslator;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class CommandTranslatorSpec extends LaravelObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType(CommandTranslator::class);
    }

    function it_translates_a_command_to_a_validator_class_name()
    {
        $this->toValidator(new DummyCommand())
            ->shouldReturn('spec\App\Commands\Validation\DummyCommandValidator');
    }

}

class DummyCommand extends Command {

}
