<a href="#" title="{{ trans('labels.trash') }}" class="btn btn-link trash">
    <i class="glyphicon glyphicon-trash"></i>
</a>

@section('trash-form')
    <form action="{{ route($route, $id) }}" method="post" class="trash hidden">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit">{{ trans('labels.trash') }}</button>
    </form>
@endsection