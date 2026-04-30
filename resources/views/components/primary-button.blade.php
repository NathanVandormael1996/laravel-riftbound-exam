<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-sentry-primary px-6 py-2.5 text-xs']) }}>
    {{ $slot }}
</button>
