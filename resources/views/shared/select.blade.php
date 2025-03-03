@php
    $class ??= null;
    $label ??= '';
    $name ??= '';
    $values ??= null;
    $options ??= [];
    $attr ??= '';
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name . ($attr === 'multiple' ? '[]' : '') }}" id="{{ $name }}" {{ $attr }}>
        <option value="">-</option>
        @foreach($options as $optKey => $optValue)
            <option @selected($values->contains($optValue)) value="{{ $optValue }}">{{ $optKey }}</option>
        @endforeach
    </select>
    @error($name)
        {{ $message }}
    @enderror
</div>