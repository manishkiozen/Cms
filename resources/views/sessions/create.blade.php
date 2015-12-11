@extends('app')

@section('title', trans('authentication.login'))

@section('content')
    <form action="{{ route('session.store') }}" method="post" class="col-xs-12 col-md-6 col-md-offset-3">
        <h1 class="page-header">{{ trans('authentication.login') }}</h1>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_session" value="post">
        <fieldset>
            <div class="form-group">
                <label for="email">{{ trans('authentication.email') }}</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">{{ trans('authentication.password') }}</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="1">
                    {{ trans('authentication.remember') }}
                </label>
            </div>
            <button type="submit" class="btn btn-success">{{ trans('authentication.login') }}</button>
        </fieldset>
    </form>
@endsection