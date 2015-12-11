@extends('app')

@section('title', trans('vat-rates.index'))

@section('content')

    {!! Toolbar::make('control-panel-toolbar')
        ->create('vat-rate.create')
        ->search() !!}

    <div class="container">
        @if($q)
            <h2>
                {{ trans('vat-rates.results_for', ['q' => $q]) }}
                <small><a href="{{ route('vat-rate.index') }}" class="reset-q">{!! trans('vat-rates.show_all') !!}</a></small>
            </h2>
        @endif
        <table class="table table-hover" id="vat-rate-index">
            <thead>
                <tr>
                    <th>{{ trans('vat-rates.description') }}</th>
                    <th>{{ trans('vat-rates.rate') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $model)
                    <tr class="clickable" data-href="{{ route('vat-rate.edit', $model->id) }}">
                        <td><a href="{{ route('vat-rate.edit', $model->id) }}">{{ $model->description }}</a></td>
                        <td>{{ $model->rate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $collection->render() !!}
    </div>

@endsection