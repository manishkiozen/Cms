<div class="row tab-pane" id="tab-selling">
    <div class="col-xs-12 col-md-6">
        <fieldset>
            <legend>{{ trans('products.selling') }}</legend>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="can_be_sold" value="1" {{ $model->can_be_sold ? 'checked' : '' }}>
                    {{ trans('products.can_be_sold') }}
                </label>
            </div>
        </fieldset>
        <fieldset>
            <legend>{{ trans('products.pricing') }}</legend>
            <div class="form-group">
                <label for="vat_rate_id">{{ trans_choice('vat-rates.vat_rate', 1) }}</label>
                <select name="vat_rate_id" class="form-control" required>
                    @foreach($vat_rates as $vat_rate)
                        <option value="{{ $vat_rate->id }}"{{ $vat_rate->id == $model->vat_rate_id ? ' selected' : '' }}>
                            {{ $vat_rate->description }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="selling_price">{{ trans('products.selling_price') }}</label>
                <input type="number" name="selling_price" id="selling_price" value="{{ Input::old('selling_price', $model->selling_price) }}" min="0" step=".01" class="form-control">
                @include('errors.validation', ['error' => $errors->first('selling_price')])
            </div>
            <div class="form-group">
                <label for="recommended_retail_price">{{ trans('products.recommended_retail_price') }}</label>
                <input type="number" name="recommended_retail_price" id="recommended_retail_price" value="{{ Input::old('recommended_retail_price', $model->recommended_retail_price) }}" min="0" step=".01" class="form-control">
                @include('errors.validation', ['error' => $errors->first('recommended_retail_price')])
            </div>
        </fieldset>
    </div>
</div>