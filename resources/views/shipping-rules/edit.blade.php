@extends('app')

@section('title', trans('shipping-rules.edit'))

@section('content')

    <form action="{{ route('shipping-rule.update', $model->id) }}" method="post">
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('control-panel-toolbar')
            ->store()
            ->cancel('shipping-rule.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label>{{ trans('shipping-rules.carrier') }}</label>
                            <p class="form-control-static">{{ $model->carrier->name }}</p>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('shipping-rules.country') }}</label>
                            <p class="form-control-static">{{ $model->country->name }}</p>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_enabled" id="is_enabled" value="1" {{ Input::old('is_enabled', $model->is_enabled) ? 'checked' : '' }}>
                                {{ trans('shipping-rules.is_enabled') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="delivery_time">{{ trans('shipping-rules.delivery_time') }}</label>
                            <input type="text" name="delivery_time" id="delivery_time" value="{{ Input::old('delivery_time', $model->delivery_time) }}" class="form-control" required autofocus>
                            @include('errors.validation', ['error' => $errors->first('delivery_time')])
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection