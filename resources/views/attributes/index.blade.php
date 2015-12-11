@extends('app')

@section('title', trans('attributes.index'))

@section('content')

    {!! Toolbar::make('control-panel-toolbar')
        ->create('attribute.create')
        ->search() !!}

    <div class="container">
        @if($q)
            <h2>
                {{ trans('attributes.results_for', ['q' => $q]) }}
                <small><a href="{{ route('attributes.index') }}" class="reset-q">{!! trans('attributes.show_all') !!}</a></small>
            </h2>
        @endif
        <table class="table table-hover" id="attribute-index">
            <thead>
                <tr>
                    <th>{{ trans('attributes.description') }}</th>
                    <th>{{ trans('attributes.type') }}</th>
                    <th>{{ trans('attributes.unit_of_measurement') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $model)
                    <tr class="clickable" data-href="{{ route('attribute.edit', $model->id) }}">
                        <td><a href="{{ route('attribute.edit', $model->id) }}">{{ $model->description }}</a></td>
                        <td>{{ trans('attributes.' . $model->type) }}</td>
                        <td>{{ $model->unit_of_measurement }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $collection->render() !!}
    </div>

@endsection