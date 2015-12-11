@extends('app')

@section('title', trans('countries.edit'))

@section('content')

    <form action="{{ route('country.update', $model->id) }}" method="post">
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! \App\Html\Toolbar::make('control-panel-toolbar')
            ->store()
            ->cancel('country.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="iso_code_2">{{ trans('countries.iso_code_2') }}</label>
                            <input type="text" name="iso_code_2" id="iso_code_2" value="{{ Input::old('iso_code_2', $model->iso_code_2) }}" class="form-control" required autofocus>
                            @include('errors.validation', ['error' => $errors->first('iso_code_2')])
                            <span class="help-block">{{ trans('labels.must_be_unique') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="name">{{ trans('countries.name') }}</label>
                            <input type="text" name="name" id="name" value="{{ Input::old('name', $model->name) }}" class="form-control" required>
                            @include('errors.validation', ['error' => $errors->first('name')])
                        </div>
                        <div class="checkbox">
                            <label for="is_area_of_sales">
                                <input type="checkbox" name="is_area_of_sales" id="is_area_of_sales" value="1"{{ Input::old('is_area_of_sales', $model->is_area_of_sales) ? ' checked' : '' }}>
                                {{ trans('countries.is_area_of_sales') }}
                            </label>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection