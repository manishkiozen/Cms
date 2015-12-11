@extends('app')

@section('title', trans('product-types.create'))

@section('content')

    <form action="{{ route('product-type.store') }}" method="post">
        <input type="hidden" name="_method" value="post">
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
                            <input type="text" name="description" id="description" value="{{ Input::old('description') }}" class="form-control" required>
                            @include('errors.validation', ['error' => $errors->first('description')])
                            <span class="help-block">{{ trans('labels.must_be_unique') }}</span>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection