<div class="row tab-pane" id="tab-buying">
    <div class="col-xs-12 col-md-6">
        <fieldset>
            <legend>{{ trans('products.purchasing') }}</legend>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="can_be_purchased" value="1" {{ $model->canBePurchased ? 'checked' : '' }}>
                    {{ trans('products.can_be_purchased') }}
                </label>
            </div>
            <div class="form-group">
                <label for="supplier_id">{{ trans('products.supplier') }}</label>
                <select name="supplier_id" id="supplier_id" class="form-control">
                    <option value=""></option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $supplier->id == $model->supplier_id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="delivery_time">{{ trans('products.delivery_time') }}</label>
                <div class="input-group">
                    <input type="number" name="delivery_time" id="delivery_time" value="{{ $model->delivery_time }}" class="form-control" min="1">
                    <div class="input-group-addon">{{ trans('products.days') }}</div>
                    @include('errors.validation', ['error' => $errors->first('delivery_time')])
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>{{ trans('products.pricing') }}</legend>
            <div class="form-group">
                <label for="purchase_price">{{ trans('products.purchase_price') }}</label>
                <input type="number" name="purchase_price" id="purchase_price" value="{{ Input::old('purchase_price', $model->purchase_price) }}" min="0" step=".01" class="form-control">
                @include('errors.validation', ['error' => $errors->first('purchase_price')])
            </div>
        </fieldset>
    </div>
</div>