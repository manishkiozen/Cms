@extends('app')

@section('title', trans('suppliers.create'))

@section('content')

    <form action="{{ route('supplier.store') }}" method="post">
        <input type="hidden" name="_method" value="post">
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
                            <input type="text" name="name" id="name" value="{{ Input::old('name') }}" class="form-control" required>
                            @include('errors.validation', ['error' => $errors->first('name')])
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection