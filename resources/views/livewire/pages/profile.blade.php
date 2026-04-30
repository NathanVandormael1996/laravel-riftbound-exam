<?php
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
new #[Layout('layouts.app')] class extends Component
{
}; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h1 class="font-display text-4xl font-bold text-white mb-2">Identity Dossier</h1>
            <p class="text-sentry-light opacity-60 uppercase tracking-[2px] text-xs">Manage your credentials and security clearances</p>
        </div>
        <div class="space-y-12">
            <div class="sentry-card p-8 md:p-12">
                <div class="max-w-xl">
                    <h2 class="text-xl font-bold text-white mb-6">Profile Information</h2>
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>
            <div class="sentry-card p-8 md:p-12">
                <div class="max-w-xl">
                    <h2 class="text-xl font-bold text-white mb-6">Security Access Code</h2>
                    <livewire:profile.update-password-form />
                </div>
            </div>
            <div class="sentry-card p-8 md:p-12 border-sentry-pink/30">
                <div class="max-w-xl">
                    <h2 class="text-xl font-bold text-sentry-pink mb-6">Deactivate Identity</h2>
                    <p class="text-sm text-sentry-light opacity-60 mb-8">Once your identity is deactivated, all acquisition history and dossiers will be permanently purged.</p>
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</div>
