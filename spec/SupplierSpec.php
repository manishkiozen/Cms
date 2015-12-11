<?php

namespace spec\App;

use App\Supplier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SupplierSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Supplier');
    }

    function it_can_be_registered()
    {
        $supplier = Supplier::register('Acme Logistics');
        \PHPUnit_Framework_Assert::assertEquals('Acme Logistics', $supplier->name);
    }
}
