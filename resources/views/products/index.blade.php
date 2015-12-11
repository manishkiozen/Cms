@extends('app')

@section('title', trans('products.index'))

@section('content')

    {!! Toolbar::make('products-toolbar')
        ->create('product.create')
        ->search() !!}

    <div class="container">
        @if($q)
            <h2>
                {{ trans('products.results_for', ['q' => $q]) }}
                <small><a href="{{ route('product.index') }}" class="reset-q">{!! trans('products.show_all') !!}</a></small>
            </h2>
        @endif
        <table class="table table-hover" id="product-index">
            <thead>
                <tr>
                    <th class="col-xs-2">{{ trans('products.product_number') }}</th>
                    <th>{{ trans('products.description') }}</th>
                    <th class="col-xs-2">{{ trans('products.selling_price') }}</th>
                </tr>
            </thead>
            <tbody id="product-index">
                @foreach($collection as $model)
                    <tr class="clickable" data-href="{{ route('product.edit', $model->id) }}">
                        <td><a href="{{ route('product.edit', $model->id) }}">{{ $model->product_number }}</a></td>
                        <td>{{ $model->description }}</td>
                        <td>{{ $model->selling_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $collection->render() !!}
    </div>

@endsection