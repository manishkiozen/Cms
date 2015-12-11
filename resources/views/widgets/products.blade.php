@if($current_user instanceof App\User)
    <div class="widget products-widget">
        <a href="{{ route('product.index') }}" class="btn btn-default">{{ trans('products.index') }}</a>
    </div>
@endif