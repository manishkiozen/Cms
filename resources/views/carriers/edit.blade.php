@extends('app')

@section('title', trans('carrier.edit'))

@section('content')

    <form action="{{ route('carrier.update', $model->id) }}" method="post">
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('control-panel-toolbar')
            ->store()
            ->cancel('carrier.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="name">{{ trans('carriers.name') }}</label>
                            <input type="text" name="name" id="name" value="{{ Input::old('name', $model->name) }}" class="form-control" required autofocus>
                            @include('errors.validation', ['error' => $errors->first('name')])
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_default_carrier" {{ $model->is_default_carrier ? 'checked disabled' : '' }}>
                                {{ trans('carriers.is_default_carrier') }}
                            </label>
                            <p class="help-block">{{ trans('carriers.make_default_carrier') }}</p>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>
@endsection