@props(['value'])
<label {{ $attributes->merge(['class' => 'block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-60 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
