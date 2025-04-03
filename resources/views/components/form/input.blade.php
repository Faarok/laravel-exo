@props([
    'label' => null,
    'type' => 'text',
    'class' => '',
    'name' => '',
    'attr' => null,
    'value' => '',
    'icon' => null,
    'placeholder' => ''
])

<div {{ $attributes->merge(['class' => "$class"]) }}>
    @if(!empty($label))
        <label class="label" for="{{ $name }}">{{ $label }}</label>
    @endif

    @if($errors->has($name) || isset($icon))
        <div class="control {{ isset($icon) ? 'has-icons-left' : '' }} @error($name) has-icons-right @enderror">
    @endif

        <input
            id="{{ $name }}"
            class="input @error($name) is-danger @enderror"
            value="{{ $value !== null ? old($name, $value) : old($name) }}"
            type="{{ $type }}"
            {{ $type === 'number' ? 'step=1' : '' }}
            name="{{ $name . ($attr === 'multiple' ? '[]' : '') }}"
            {{ $attr }}
            placeholder="{{ $placeholder }}"
        >

        @if(isset($icon))
            <span class="icon is-small is-left">
                <i {{ $attributes->merge(['class' => "fas fa-$icon"]) }}></i>
            </span>
        @endif

        @error($name)
            <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
        @enderror
    @if($errors->has($name) || isset($icon))
        </div>
    @endif

    @error($name)
        <p class="help is-danger">{{ $message }}</p>
    @enderror
</div>