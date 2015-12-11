<?php

namespace spec\App;

use App\AttributeValue;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AttributeValueSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\AttributeValue');
    }

    function it_can_be_registered()
    {
        $value = AttributeValue::register(1, 'Blue');
        \PHPUnit_Framework_Assert::assertEquals(1, $value->attribute_id);
        \PHPUnit_Framework_Assert::assertEquals('Blue', $value->value);
    }
}
