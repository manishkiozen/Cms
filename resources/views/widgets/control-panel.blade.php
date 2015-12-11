@if($current_user instanceof App\User)
    <div class="dropdown widget control-panel-widget">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="glyphicon glyphicon-cog"></i>
            <i class="caret"></i>
        </button>
        <ul class="dropdown-menu" role="menu">
            @foreach($control_panel_links as $route => $description)
                <li><a href="{{ route($route) }}">{{ $description }}</a></li>
            @endforeach
        </ul>
    </div>
@endif
