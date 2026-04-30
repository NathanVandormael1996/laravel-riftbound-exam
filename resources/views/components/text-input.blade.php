@props(['disabled' => false])
<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-sentry-darker border-sentry-border text-white focus:border-sentry-purple focus:ring-sentry-purple rounded-lg shadow-sm placeholder-sentry-muted/50']) }}>
