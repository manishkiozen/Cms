@extends('app')

@section('title', trans('suppliers.index'))

@section('content')

    {!! Toolbar::make('control-panel-toolbar')
        ->create('supplier.create')
        ->search() !!}

    <div class="container">
        @if($q)
            <h2>
                {{ trans('suppliers.results_for', ['q' => $q]) }}
                <small><a href="{{ route('supplier.index') }}" class="reset-q">{!! trans('suppliers.show_all') !!}</a></small>
            </h2>
        @endif
        <table class="table table-hover" id="supplier-index">
            <thead>
                <tr>
                    <th>{{ trans('suppliers.name') }}</th>
                    <th>{{ trans('suppliers.attention') }}</th>
                    <th>{{ trans('suppliers.email') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $model)
                    <tr class="clickable" data-href="{{ route('supplier.edit', $model->id) }}">
                        <td><a href="{{ route('supplier.edit', $model->id) }}">{{ $model->name }}</a></td>
                        <td>{{ $model->attention }}</td>
                        <td>{{ $model->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $collection->render() !!}
    </div>

@endsection