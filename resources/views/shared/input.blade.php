@php
    $label ??= null;
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $attr ??= '';
    $value ??= null;
@endphp

<div @class(['form-group', $class])>
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>

    @if ($type === 'textarea')
        <textarea type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"">{{ old($name, $value) }}</textarea>
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    @else
        <input type="{{ $type }}" {{ $type === 'number' ? 'step=1' : '' }} id="{{ $name }}" name="{{ $name }}{{ $attr === 'multiple' ? '[]' : '' }}" {{ $attr }} class="form-control @error($name) is-invalid @enderror" value="{{ $value ? old($name, $value) : old($name) }}">
        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    @endif
</div>