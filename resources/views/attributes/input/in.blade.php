<select name="attributes[{{ $attribute->id }}]" id="attribute-{{ $attribute->id }}" class="form-control"
        {{ $attribute->unit_of_measurement ? 'aria-describedby="attribute-addon-' . $attribute->id . '"' : '' }}>
    <option value=""></option>
    @foreach($attribute->values->sortBy('value') as $option)
        <option value="{{ $option->id }}" {{ $option->id == $value ? 'selected' : '' }}>{{ $option->value }}</option>
    @endforeach
</select>