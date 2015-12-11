<?php

namespace spec\App;

use App\Attribute;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AttributeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Attribute');
    }

    function it_can_be_registered()
    {
        $attribute = Attribute::register('Author', 'string');

        \PHPUnit_Framework_Assert::assertEquals('Author', $attribute->description);
        \PHPUnit_Framework_Assert::assertEquals('string', $attribute->type);
    }

    function it_provides_a_list_of_possible_types()
    {
        $types = Attribute::getAllowedTypes();

        \PHPUnit_Framework_Assert::assertEquals([
            'string',
            'numeric',
            'in',
        ], $types);
    }
}
