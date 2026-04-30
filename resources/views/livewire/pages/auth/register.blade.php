<?php

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = UserRole::USER->value;

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        // Merge cart after registration
        app(\App\Services\CartService::class)->mergeSessionCartWithUser();

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="space-y-6">
    <div class="text-center space-y-2">
        <h1 class="text-3xl font-bold font-display tracking-tight text-white">Join Riftbound</h1>
        <p class="text-sentry-light opacity-60 text-sm uppercase tracking-widest">Apply for your identity today</p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <!-- Name -->
        <div class="space-y-1">
            <label for="name" class="sentry-label text-[10px]">Chosen Name</label>
            <input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name" class="sentry-input w-full" placeholder="Katarina Du Couteau" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div class="space-y-1">
            <label for="email" class="sentry-label text-[10px]">Email Address</label>
            <input wire:model="email" id="email" type="email" name="email" required autocomplete="username" class="sentry-input w-full" placeholder="noxian.might@empire.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <label for="password" class="sentry-label text-[10px]">Access Code</label>
            <input wire:model="password" id="password" type="password" name="password" required autocomplete="new-password" class="sentry-input w-full" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1">
            <label for="password_confirmation" class="sentry-label text-[10px]">Confirm Code</label>
            <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="sentry-input w-full" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-6">
            <button class="w-full btn-sentry-primary py-4">
                Establish Identity
            </button>
        </div>
    </form>

    <div class="text-center border-t border-sentry-border/50 pt-6">
        <p class="text-[10px] sentry-label opacity-40">
            Already identified? <a href="{{ route('login') }}" wire:navigate class="text-sentry-purple hover:text-sentry-light transition-colors">Verify Here</a>
        </p>
    </div>
</div>
