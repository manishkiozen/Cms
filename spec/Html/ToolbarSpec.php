<?php namespace spec\App\Html;

use App\Html\Toolbar;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class ToolbarSpec extends LaravelObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('App\Html\Toolbar');
    }

    function it_can_be_factored_for_method_chaining()
    {
        \PHPUnit_Framework_Assert::assertInstanceOf(Toolbar::class, Toolbar::make());
    }

    function it_accepts_tools()
    {
        $this->addTool('test')->shouldReturn($this);
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBeString();
    }

    function it_can_be_rendered_automatically_in_views()
    {
        $toolbar = $this->addTool('test');
        \PHPUnit_Framework_Assert::stringStartsWith('<nav class="navbar navbar-default toolbar', $toolbar);
        \PHPUnit_Framework_Assert::stringEndsWith('</nav>', $toolbar);
    }

    function it_can_have_a_cancel_button()
    {
        $this->cancel('home')->shouldReturn($this);
    }

    function it_can_have_a_create_button()
    {
        $this->create('product.create')->shouldReturn($this);
    }

    function it_can_have_a_store_button()
    {
        $this->store()->shouldReturn($this);
    }

    function it_can_have_a_search_form()
    {
        $this->search()->shouldReturn($this);
    }

    function it_can_have_a_trash_button()
    {
        $this->trash('product.destroy', 1)->shouldReturn($this);
    }

}
