@extends('app')

@section('title', trans('CHANGE_ME.create'))

@section('content')

    <form action="{{ route('CHANGE_ME.store') }}" method="post">
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('control-panel-toolbar')
            ->store()
            ->cancel('CHANGE_ME.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="CHANGE_ME">{{ trans('CHANGE_ME.CHANGE_ME') }}</label>
                            <input type="text" name="CHANGE_ME" id="CHANGE_ME" value="{{ Input::old('CHANGE_ME') }}" class="form-control" required>
                            @include('errors.validation', ['error' => $errors->first('CHANGE_ME')])
                            <span class="help-block">{{ trans('labels.must_be_unique') }}</span>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection