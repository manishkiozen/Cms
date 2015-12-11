<nav class="navbar widgetbar">
    <ul class="nav navbar-nav">
        @foreach(['products', 'control-panel', 'user'] as $widget)
            <li>@include('widgets.' . $widget)</li>
        @endforeach
    </ul>
</nav>