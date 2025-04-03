@props(['type' => 'success', 'message' => null])

@if($message)
    <div {{ $attributes->merge(['class' => "notification is-$type"]) }}>
        <button class="delete"></button>
        @if(is_array($message))
            <ul>
                @foreach ($message as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @else
            {{ $message }}
        @endif
    </div>
@endif