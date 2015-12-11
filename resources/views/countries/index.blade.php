@extends('app')

@section('title', trans('countries.index'))

@section('content')

    {!! Toolbar::make('control-panel-toolbar')
        ->create('country.create')
        ->search() !!}

    <div class="container">
        @if($q)
            <h2>
                {{ trans('countries.results_for', ['q' => $q]) }}
                <small><a href="{{ route('country.index') }}" class="reset-q">{!! trans('countries.show_all') !!}</a></small>
            </h2>
        @endif
        <table class="table table-hover" id="country-index">
            <thead>
                <tr>
                    <th>{{ trans('countries.name') }}</th>
                    <th>{{ trans('countries.iso_code_2') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $model)
                    <tr class="clickable" data-href="{{ route('country.edit', $model->id) }}">
                        <td><a href="{{ route('country.edit', $model->id) }}">{{ $model->name }}</a></td>
                        <td>{{ $model->iso_code_2 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $collection->render() !!}
    </div>

@endsection