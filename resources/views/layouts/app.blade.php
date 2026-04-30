<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Riftbound Marketplace') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-sentry-darker text-sentry-light min-h-screen">
        <div class="relative min-h-screen">
            <livewire:layout.navigation />
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-sentry-deep border-b border-sentry-border">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <footer class="border-t border-sentry-border mt-20 py-12 bg-sentry-deep/30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex flex-col items-center md:items-start space-y-2">
                        <div class="text-2xl font-display font-bold tracking-tighter">RIFTBOUND</div>
                        <div class="text-xs sentry-label opacity-40 uppercase tracking-[3px]">The Marketplace of the Gods</div>
                    </div>
                    <div class="text-xs opacity-30">
                        &copy; {{ date('Y') }} Riftbound Card Game. All rights reserved. Not affiliated with Riot Games.
                    </div>
                </div>
            </footer>
        </div>
        <livewire:support.notification />
    </body>
</html>
