<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Riftbound Auth') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-sentry-darker text-sentry-light min-h-screen selection:bg-sentry-purple selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-sentry-purple/10 rounded-full blur-[120px]"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-sentry-pink/10 rounded-full blur-[120px]"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-sentry-deep/20 rounded-full blur-[150px]"></div>
            </div>
            <div class="mb-12">
                <a href="/" wire:navigate class="flex flex-col items-center space-y-4 group">
                    <img src="https://gamingdna.co.nz/cdn/shop/files/da447dd2-f720-43f5-b26b-f8b9b9bc1849-1761375941496_28aff86c-6f3e-4622-a5d0-67779406b921_1024x.webp?v=1773733223" alt="Riftbound Logo" class="h-20 w-auto object-contain drop-shadow-[0_0_30px_rgba(208,191,255,0.3)] group-hover:drop-shadow-[0_0_50px_rgba(208,191,255,0.5)] transition-all duration-500 animate-float">
                    <div class="text-4xl font-display font-bold tracking-tighter text-white">RIFTBOUND</div>
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-8 py-10 sentry-glass shadow-2xl relative">
                <!-- Border Accent -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-[2px] bg-gradient-to-r from-transparent via-sentry-purple to-transparent"></div>
                {{ $slot }}
            </div>
            <div class="mt-12 text-center">
                <a href="/" wire:navigate class="text-xs sentry-label opacity-40 hover:opacity-100 transition-opacity flex items-center gap-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Marketplace
                </a>
            </div>
        </div>
    </body>
</html>
