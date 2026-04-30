<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-sentry-deep text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" wire:navigate class="flex flex-col items-center gap-4">
                    <div class="w-16 h-16 bg-sentry-light rounded-2xl flex items-center justify-center shadow-[0_0_40px_rgba(208,191,255,0.2)]">
                        <span class="text-sentry-deep font-bold text-3xl">R</span>
                    </div>
                    <span class="font-display text-2xl font-bold tracking-tight text-white uppercase tracking-[4px]">Riftbound</span>
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-sentry-darker border border-sentry-border shadow-[0_20px_60px_rgba(0,0,0,0.5)] overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
