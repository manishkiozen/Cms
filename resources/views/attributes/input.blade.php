<div class="form-group">
    <label for="attribute-{{ $attribute->id }}">{{ $attribute->description }}</label>
    @if($attribute->unit_of_measurement)
        <div class="input-group">
            @include('attributes.input.' . $attribute->type, ['value' => is_null($value) ? null : $value->pivot->value])
            <span class="input-group-addon">{{ $attribute->unit_of_measurement }}</span>
        </div>
    @else
        @include('attributes.input.' . $attribute->type, ['value' => is_null($value) ? null : $value->pivot->value])
    @endif
</div>