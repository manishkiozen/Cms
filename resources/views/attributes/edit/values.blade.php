@if($model->supportsValues())
    <div class="row tab-pane" id="tab-buying">
        <div class="col-xs-12 col-md-6">
            <fieldset>
                <legend>{{ trans('attributes.values') }}</legend>
                <div class="form-group">
                    <label for="add_value">{{ trans('attributes.add_value') }}</label>
                    <input type="text" name="add_value" id="add_value" class="form-control">
                </div>
            </fieldset>
            <ul>
                @foreach($model->values->sortBy('value') as $value)
                    <li>{{ $value->value }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif