@extends('app')

@section('title', trans('product-types.edit'))

@section('content')

    <form action="{{ route('product-type.update', $model->id) }}" method="post">
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('control-panel-toolbar')
            ->store()
            ->cancel('product-type.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="description">{{ trans('product-types.description') }}</label>
                            <input type="text" name="description" id="description" value="{{ Input::old('description', $model->description) }}" class="form-control" required autofocus>
                            @include('errors.validation', ['error' => $errors->first('description')])
                            <span class="help-block">{{ trans('labels.must_be_unique') }}</span>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <fieldset>
                        <legend>{{ trans('product-types.attributes') }}</legend>
                        <ul class="list-unstyled">
                            @foreach($attributes as $attribute)
                                <li class="checkbox">
                                    <label>
                                        <input type="checkbox" name="attributes[]" value="{{ $attribute->id }}" {{ $model->attributes->contains($attribute) ? 'checked' : '' }}>
                                        {{ $attribute->description }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection