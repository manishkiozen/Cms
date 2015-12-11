@extends('app')

@section('title', trans('product-types.index'))

@section('content')

    {!! Toolbar::make('control-panel-toolbar')
        ->create('product-type.create')
        ->search() !!}

    <div class="container">
        <table class="table table-hover" id="product-type-index">
            <thead>
                <tr>
                    <th>{{ trans('product-types.description') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $model)
                    <tr class="clickable" data-href="{{ route('product-type.edit', $model->id) }}">
                        <td><a href="{{ route('product-type.edit', $model->id) }}">{{ $model->description }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection