<?php

namespace spec\App;

use App\ProductType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\ProductType');
    }

    function it_can_be_registered()
    {
        $type = ProductType::register('Book');

        \PHPUnit_Framework_Assert::assertEquals('Book', $type->description);
    }
}
