@extends('app')

@section('title', trans('products.edit'))

@section('content')

    <form action="{{ route('product.update', $model->id) }}" method="post">
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('products-toolbar')
            ->store()
            ->cancel('product.index')
            ->trash('product.destroy', $model->id) !!}

        <div class="container">
            @include('products.edit.tabs')
            <div class="tab-content">
                @include('products.edit.description')
                @include('products.edit.buying')
                @include('products.edit.selling')
            </div>
        </div>
    </form>

@endsection