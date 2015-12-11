<?php

namespace spec\App;

use App\Country;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CountrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Country');
    }

    function it_can_be_registered()
    {
        $country = Country::register('NL', 'Netherlands');

        \PHPUnit_Framework_Assert::assertEquals('NL', $country->iso_code_2);
        \PHPUnit_Framework_Assert::assertEquals('Netherlands', $country->name);
    }
}
