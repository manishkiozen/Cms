@extends('app')

@section('title', trans('vat-rates.edit'))

@section('content')

    <form action="{{ route('vat-rate.update', $model->id) }}" method="post">
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('control-panel-toolbar')
                ->store()
                ->cancel('vat-rate.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="description">{{ trans('vat-rates.description') }}</label>
                            <input type="text" name="description" id="description" value="{{ Input::old('description', $model->description) }}" class="form-control" required autofocus>
                            @include('errors.validation', ['error' => $errors->first('description')])
                        </div>
                        <div class="form-group">
                            <label for="rate">{{ trans('vat-rates.rate') }}</label>
                            <div class="input-group">
                                <input type="number" name="rate" id="rate" value="{{ Input::old('rate', $model->rate) }}" class="form-control" min="0" step=".01" required>
                                <div class="input-group-addon">%</div>
                            </div>
                            @include('errors.validation', ['error' => $errors->first('rate')])
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection