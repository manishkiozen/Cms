<nav class="navbar navbar-default toolbar {{ $css_class }}">
    <ul class="nav navbar-nav">
        @foreach($tools as $tool)
            <li>{!! $tool !!}</li>
        @endforeach
    </ul>
</nav>