@extends('app')

@section('title', trans('products.create'))

@section('content')

    <form action="{{ route('product.store') }}" method="post">
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! \App\Html\Toolbar::make('products-toolbar')
            ->store()
            ->cancel('product.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="product_type_id">{{ trans('products.product_type') }}</label>
                            <select name="product_type_id" id="product_type_id" class="form-control" required>
                                @foreach($product_types as $product_type)
                                    <option value="{{ $product_type->id }}" {{ $product_type->id == Input::old('product_type_id') ? 'selected' : '' }}>
                                        {{ $product_type->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="product_number">{{ trans('products.product_number') }}</label>
                            <input type="text" name="product_number" id="product_number" value="{{ Input::old('product_number') }}" class="form-control" required>
                            @include('errors.validation', ['error' => $errors->first('product_number')])
                            <span class="help-block">{{ trans('labels.must_be_unique') }}</span>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group">
                            <label for="description">{{ trans('products.description') }}</label>
                            <input type="text" name="description" id="description" value="{{ Input::old('description') }}" class="form-control" required>
                            @include('errors.validation', ['error' => $errors->first('description')])
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection