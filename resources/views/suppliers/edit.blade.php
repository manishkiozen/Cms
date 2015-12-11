@extends('app')

@section('title', trans('suppliers.edit'))

@section('content')

    <form action="{{ route('supplier.update', $model->id) }}" method="post">
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('control-panel-toolbar')
            ->store()
            ->cancel('supplier.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="name">{{ trans('suppliers.name') }}</label>
                            <input type="text" name="name" id="name" value="{{ Input::old('name', $model->name) }}" class="form-control" required autofocus>
                            @include('errors.validation', ['error' => $errors->first('name')])
                        </div>
                        <div class="form-group">
                            <label for="attention">{{ trans('suppliers.attention') }}</label>
                            <input type="text" name="attention" id="attention" value="{{ Input::old('attention', $model->attention) }}" class="form-control">
                            @include('errors.validation', ['error' => $errors->first('attention')])
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('suppliers.email') }}</label>
                            <input type="email" name="email" id="email" value="{{ Input::old('email', $model->email) }}" class="form-control">
                            @include('errors.validation', ['error' => $errors->first('email')])
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection