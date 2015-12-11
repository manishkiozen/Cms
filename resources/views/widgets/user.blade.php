<div class="dropdown widget user-widget">
    @if($current_user instanceof App\User)
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="glyphicon glyphicon-user"></i>
            {{ $current_user->name }}
            <i class="caret"></i>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('session.destroy') }}">{{ trans('authentication.logout') }}</a></li>
        </ul>
    @else
        <a href="{{ route('session.create') }}" class="btn">
            <i class="glyphicon glyphicon-user"></i>
            {{ trans('authentication.login') }}
        </a>
    @endif
</div>
