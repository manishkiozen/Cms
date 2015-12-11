@extends('app')

@section('title', trans('attributes.create'))

@section('content')

    <form action="{{ route('attribute.store') }}" method="post">
        <input type="hidden" name="_method" value="post">
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
                            <input type="text" name="description" id="description" value="{{ Input::old('description') }}" class="form-control" required>
                            @include('errors.validation', ['error' => $errors->first('description')])
                        </div>
                        <div class="form-group">
                            @foreach($allowed_types as $type)
                                <label class="radio-inline">
                                    <input type="radio" name="type" value="{{ $type }}" {{ Input::old('type', 'string') == $type ? 'checked' : '' }} required>
                                    {{ trans('attributes.' . $type) }}
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection