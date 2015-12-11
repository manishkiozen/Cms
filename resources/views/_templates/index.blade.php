@extends('app')

@section('title', trans('CHANGE_ME.index'))

@section('content')

    {!! Toolbar::make('control-panel-toolbar')
        ->create('CHANGE_ME.create')
        ->search() !!}

    <div class="container">
        @if($q)
            <h2>
                {{ trans('CHANGE_ME.results_for', ['q' => $q]) }}
                <small><a href="{{ route('CHANGE_ME.index') }}" class="reset-q">{!! trans('CHANGE_ME.show_all') !!}</a></small>
            </h2>
        @endif
        <table class="table table-hover" id="CHANGE_ME-index">
            <thead>
                <tr>
                    <th>{{ trans('CHANGE_ME.CHANGE_ME') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $model)
                    <tr class="clickable" data-href="{{ route('CHANGE_ME.edit', $model->id) }}">
                        <td><a href="{{ route('CHANGE_ME.edit', $model->id) }}">{{ $model->CHANGE_ME }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $collection->render() !!}
    </div>

@endsection