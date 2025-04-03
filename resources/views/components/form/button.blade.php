<button
    {{ isset($type) ? "type=$type" : '' }}
    {{ $attributes->merge(['class' => "button is-$color $customClass"]) }}
    {{ !empty($alpineFunc) ? "x-on:click=$alpineFunc" : '' }}
>
    {{ $slot }}
</button>