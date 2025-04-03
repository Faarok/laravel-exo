@props([
    'class' => '',
    'label' => '',
    'name' => '',
    'value' => '',
    'rows' => null,
    'cols' => null,
    'placeholder' => ''
])

<div {{ $attributes->merge(['class' => "field $class"]) }}>
    <label class="label" for="{{ $name }}">{{ $label }}</label>

    <div class="control">
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            class="textarea @error($name) is-danger @enderror"
            {{ !empty($rows) ? "rows=\"$rows\"" : '' }}
            {{ !empty($cols) ? "cols=\"$cols\"" : '' }}
            placeholder="{{ $placeholder }}"
        >{{ old($name, $value) }}</textarea>
    </div>

    @error($name)
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>