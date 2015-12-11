@extends('app')

@section('title', trans('shipping-rules.create'))

@section('content')

    <form action="{{ route('shipping-rule.store') }}" method="post">
        <input type="hidden" name="_method" value="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {!! Toolbar::make('control-panel-toolbar')
            ->store()
            ->cancel('shipping-rule.index') !!}

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="carrier_id">{{ trans('shipping-rules.carrier') }}</label>
                            <select name="carrier_id" id="carrier_id" class="form-control" required>
                                @foreach($carriers as $carrier)
                                    <option value="{{ $carrier->id }}" {{ Input::old('carrier_id') == $carrier->id ? 'selected' : '' }}>{{ $carrier->name }}</option>
                                @endforeach
                            </select>
                            @include('errors.validation', ['error' => $errors->first('carrier_id')])
                        </div>
                        <div class="form-group">
                            <label for="country_id">{{ trans('shipping-rules.country') }}</label>
                            <select name="country_id" id="country_id" class="form-control" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ Input::old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @include('errors.validation', ['error' => $errors->first('country_id')])
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>

@endsection