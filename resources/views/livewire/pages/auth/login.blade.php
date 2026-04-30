<?php
use App\Livewire\Forms\LoginForm;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;
    public function login(): void
    {
        $this->validate();
        $this->form->store();
        app(CartService::class)->mergeSessionCartWithUser();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>
<div class="space-y-6">
    <div class="text-center space-y-2">
        <h1 class="text-3xl font-bold font-display tracking-tight text-white">Welcome Back</h1>
        <p class="text-sentry-light opacity-60 text-sm uppercase tracking-widest">Identify yourself to continue</p>
    </div>
    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="sentry-label text-[10px]">Email Address</label>
            <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username" class="sentry-input w-full" placeholder="infiltrator@noxus.gov" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <label for="password" class="sentry-label text-[10px]">Access Code</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] sentry-label text-sentry-purple hover:text-sentry-light transition-colors" href="{{ route('password.request') }}" wire:navigate>
                        Lost Code?
                    </a>
                @endif
            </div>
            <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password" class="sentry-input w-full" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>
        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember" class="inline-flex items-center group cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox" name="remember" class="rounded bg-sentry-darker border-sentry-border text-sentry-purple focus:ring-sentry-purple transition-all">
                <span class="ms-3 sentry-label text-[10px] opacity-60 group-hover:opacity-100 transition-opacity">Stay Identified</span>
            </label>
        </div>
        <div class="pt-4">
            <button class="w-full btn-sentry-primary py-4">
                Verify Identity
            </button>
        </div>
    </form>
    <div class="pt-6 border-t border-sentry-border/50 text-center space-y-4">
        <div class="sentry-label text-[9px] opacity-40">Alternative Authentication</div>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('social.redirect', 'github') }}" class="btn-sentry-secondary py-3 text-xs flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                Github
            </a>
            <a href="{{ route('social.redirect', 'google') }}" class="btn-sentry-secondary py-3 text-xs flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.48 10.92v3.28h7.84c-.24 1.84-.9 3.33-1.91 4.33-1.21 1.21-3.1 2.53-7.1 2.53-6.4 0-11.66-5.18-11.66-11.58S4.8 2.02 11.2 2.02c3.48 0 5.97 1.38 7.82 3.14l2.42-2.42C19.1 1.05 16.03 0 12.18 0 5.48 0 0 5.48 0 12.18s5.48 12.18 12.18 12.18c3.63 0 6.37-1.19 8.52-3.4 2.21-2.21 2.91-5.32 2.91-8.12 0-.82-.07-1.58-.2-2.31h-10.93z"/></svg>
                Google
            </a>
        </div>
    </div>
    <div class="text-center">
        <p class="text-[10px] sentry-label opacity-40">
            No identity? <a href="{{ route('register') }}" wire:navigate class="text-sentry-purple hover:text-sentry-light transition-colors">Apply for Citizenship</a>
        </p>
    </div>
</div>
