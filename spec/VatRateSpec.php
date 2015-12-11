<?php namespace spec\App;

use App\VatRate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VatRateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\VatRate');
    }

    function it_can_be_registered()
    {
        $rate = VatRate::register('High', 21);

        \PHPUnit_Framework_Assert::assertEquals('High', $rate->description);
        \PHPUnit_Framework_Assert::assertEquals(21, $rate->rate);
    }

}
