<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-sentry-primary py-2 px-6']) }}>
    {{ $slot }}
</button>
