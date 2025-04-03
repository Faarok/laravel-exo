@props([
    'class' => '',
    'label' => '',
    'name' => '',
    'values' => '',
    'options' => [],
    'attr' => [],
    'placeholder' => ''
])

<label for="{{ $name }}" class="form-label">{{ $label }}</label>
<select
    {{ !empty($class) ? "class\"$class\"" : '' }}
    name="{{ $name . ($attributes['multiple'] ? '[]' : '') }}"
    id="{{ $name }}"
    placeholder="{{ $placeholder }}"
    @foreach($attributes as $key => $value)
        {{ "$key=\"$value\"" }}
    @endforeach
>
    <option value="">-</option>
    @foreach($options as $optKey => $optValue)
        <option @selected($values->contains($optValue)) value="{{ $optValue }}">{{ $optKey }}</option>
    @endforeach
</select>
@error($name)
    {{ $message }}
@enderror