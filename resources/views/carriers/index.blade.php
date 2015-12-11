@extends('app')

@section('title', trans('carriers.index'))

@section('content')

    {!! Toolbar::make('control-panel-toolbar')
        ->create('carrier.create')
        ->search() !!}

    <div class="container">
        @if($q)
            <h2>
                {{ trans('carriers.results_for', ['q' => $q]) }}
                <small><a href="{{ route('carrier.index') }}" class="reset-q">{!! trans('carriers.show_all') !!}</a></small>
            </h2>
        @endif
        <table class="table table-hover" id="carrier-index">
            <thead>
                <tr>
                    <th class="col-xs-1"></th>
                    <th>{{ trans('carriers.name') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $model)
                    <tr class="clickable" data-href="{{ route('carrier.edit', $model->id) }}">
                        <td class="text-center">
                            @if($model->is_default_carrier)
                                <i class="glyphicon glyphicon-pushpin" title="{{ trans('carriers.default_carrier') }}"></i>
                            @endif
                        </td>
                        <td><a href="{{ route('carrier.edit', $model->id) }}">{{ $model->name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $collection->render() !!}
    </div>

@endsection