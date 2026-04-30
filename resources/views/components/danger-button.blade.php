<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-sentry-primary bg-sentry-pink hover:bg-sentry-pink/80 px-6 py-2.5 text-xs shadow-[0_0_20px_rgba(240,111,151,0.2)]']) }}>
    {{ $slot }}
</button>
