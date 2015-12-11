<?php namespace spec\App;

use App\Presentation\ProductPresenter;
use App\Product;
use App\ProductType;
use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends LaravelObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType(Product::class);
    }

    public function it_can_be_registered()
    {
        $product = Product::register('123456', 'Some product', 1);

        \PHPUnit_Framework_Assert::assertEquals('123456', $product->product_number);
        \PHPUnit_Framework_Assert::assertEquals('Some product', $product->description);
        \PHPUnit_Framework_Assert::assertEquals(1, $product->product_type_id);
    }

    public function it_soft_deletes()
    {
        $this->getDeletedAtColumn()->shouldReturn('deleted_at');
    }

    public function it_has_a_presenter()
    {
        $this->getPresenterClass()->shouldReturn(ProductPresenter::class);
    }

}
