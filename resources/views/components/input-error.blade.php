@props(['messages'])
@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-[10px] font-bold text-sentry-pink space-y-1 mt-2']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
