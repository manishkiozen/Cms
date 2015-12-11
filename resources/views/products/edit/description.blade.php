<div class="row tab-pane active" id="tab-description">
    <div class="col-xs-12 col-md-6">
        <fieldset>
            <legend>{{ trans('products.description') }}</legend>
            <div class="form-group">
                <label for="product_number">{{ trans('products.product_number') }}</label>
                <p class="form-control-static">{{ $model->product_number }}</p>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('products.description') }}</label>
                <input type="text" name="description" id="description" value="{{ Input::old('description', $model->description) }}" class="form-control" required>
                @include('errors.validation', ['error' => $errors->first('description')])
            </div>
            <div class="form-group">
                <label for="detailed_description">{{ trans('products.detailed_description') }}</label>
                <textarea name="detailed_description" id="detailed_description" rows="5" class="form-control">{{ Input::old('detailed_description', $model->detailed_description) }}</textarea>
                @include('errors.validation', ['error' => $errors->first('detailed_description')])
            </div>
            <div class="form-group">
                <label for="ean">{{ trans('products.ean') }}</label>
                <input type="text" name="ean" id="ean" value="{{ Input::old('ean', $model->ean) }}" class="form-control">
                @include('errors.validation', ['error' => $errors->first('ean')])
            </div>
        </fieldset>
    </div>
    <div class="col-xs-12 col-md-6">
        <fieldset>
            <legend>{{ trans('products.attributes') }}</legend>
            <div class="form-group">
                <label for="product_type_id">{{ trans('products.product_type') }}</label>
                <p class="form-control-static">{{ $model->productType->description or trans('product-types.not_found') }}</p>
            </div>
            @forelse($model->productType->attributes->sortBy('description') as $attribute)
                @include('attributes.input', ['value' => $model->attributes->first(function ($key, $value) use ($attribute) {
                    return $value->id == $attribute->id;
                })])
            @empty
                <blockquote>
                    {{ trans('products.no_attributes_available') }}
                </blockquote>
            @endforelse
        </fieldset>
    </div>
</div>