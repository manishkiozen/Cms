@extends('app')

@section('title', trans('shipping-rules.index'))

@section('content')

    {!! Toolbar::make('control-panel-toolbar')
        ->create('shipping-rule.create') !!}

    <div class="container">
        <table class="table table-hover" id="shipping-rule-index">
            <thead>
                <tr>
                    <th class="col-xs-1">{{ trans('shipping-rules.enabled') }}</th>
                    <th>{{ trans('shipping-rules.carrier') }}</th>
                    <th>{{ trans('shipping-rules.country') }}</th>
                    <th>{{ trans('shipping-rules.delivery_time') }} ({{ trans('shipping-rules.days') }})</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $model)
                    <tr class="clickable" data-href="{{ route('shipping-rule.edit', $model->id) }}">
                        <td class="text-center">
                            @if($model->is_enabled)
                                <i class="glyphicon glyphicon-ok text-success" title="{{ trans('shipping-rules.enabled') }}"></i>
                            @endif
                        </td>
                        <td><a href="{{ route('shipping-rule.edit', $model->id) }}">{{ $model->carrier->name }}</a></td>
                        <td>{{ $model->country->name }}</td>
                        <td>{{ $model->delivery_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection