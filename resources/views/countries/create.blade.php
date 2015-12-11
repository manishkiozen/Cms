@extends('app')

@section('title', trans('countries.create'))

@section('content')

    <form action="{{ route('country.store') }}" method="post">
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('control-panel-toolbar')
            ->store()
            ->cancel('country.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="iso_code_2">{{ trans('countries.iso_code_2') }}</label>
                            <input type="text" name="iso_code_2" id="iso_code_2" value="{{ Input::old('iso_code_2') }}" class="form-control" required autofocus>
                            @include('errors.validation', ['error' => $errors->first('iso_code_2')])
                            <span class="help-block">{{ trans('labels.must_be_unique') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ trans('countries.name') }}</label>
                            <input type="text" name="name" id="name" value="{{ Input::old('name') }}" class="form-control" required>
                            @include('errors.validation', ['error' => $errors->first('name')])
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection