@extends('app')

@section('title', trans('attributes.edit'))

@section('content')

    <form action="{{ route('attribute.update', $model->id) }}" method="post">
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('control-panel-toolbar')
            ->store()
            ->cancel('attribute.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="description">{{ trans('attributes.description') }}</label>
                            <input type="text" name="description" id="description" value="{{ Input::old('description', $model->description) }}" class="form-control" required autofocus>
                            @include('errors.validation', ['error' => $errors->first('description')])
                        </div>
                        <div class="form-group">
                            <label for="type">{{ trans('attributes.type') }}</label>
                            <p class="form-control-static">{{ trans('attributes.' . $model->type) }}</p>
                        </div>
                        <div class="form-group">
                            <label for="unit_of_measurement">{{ trans('attributes.unit_of_measurement') }}</label>
                            <input type="text" name="unit_of_measurement" id="unit_of_measurement" value="{{ Input::old('unit_of_measurement', $model->unit_of_measurement) }}" class="form-control">
                            @include('errors.validation', ['error' => $errors->first('unit_of_measurement')])
                        </div>
                    </fieldset>
                </div>
            </div>

            @include('attributes.edit.values')

        </div>
    </form>

@endsection