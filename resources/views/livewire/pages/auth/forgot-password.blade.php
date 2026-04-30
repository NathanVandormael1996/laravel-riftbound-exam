<?php
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';
    public string $status = '';
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);
        $status = Password::sendResetLink(
            $this->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            $this->status = __($status);
            return;
        }
        $this->addError('email', __($status));
    }
}; ?>
<div class="space-y-6">
    <div class="text-center space-y-2">
        <h1 class="text-3xl font-bold font-display tracking-tight text-white">Lost Identity?</h1>
        <p class="text-sentry-light opacity-60 text-sm uppercase tracking-widest">We can recover your access code</p>
    </div>
    <div class="text-sm text-sentry-light opacity-70 leading-relaxed text-center">
        Enter the email address associated with your identity, and we will send you a recovery link.
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="$status" />
    <form wire:submit="sendPasswordResetLink" class="space-y-6">
        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="sentry-label text-[10px]">Email Address</label>
            <input wire:model="email" id="email" type="email" name="email" required autofocus class="sentry-input w-full" placeholder="infiltrator@noxus.gov" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="pt-4">
            <button class="w-full btn-sentry-primary py-4">
                Send Recovery Link
            </button>
        </div>
    </form>
    <div class="text-center pt-2">
        <a href="{{ route('login') }}" wire:navigate class="text-[10px] sentry-label text-sentry-purple hover:text-sentry-light transition-colors">Return to Login</a>
    </div>
</div>
