<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

?>

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
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.update-profile-information-form', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-902262906-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>
            <div class="sentry-card p-8 md:p-12">
                <div class="max-w-xl">
                    <h2 class="text-xl font-bold text-white mb-6">Security Access Code</h2>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.update-password-form', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-902262906-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>
            <div class="sentry-card p-8 md:p-12 border-sentry-pink/30">
                <div class="max-w-xl">
                    <h2 class="text-xl font-bold text-sentry-pink mb-6">Deactivate Identity</h2>
                    <p class="text-sm text-sentry-light opacity-60 mb-8">Once your identity is deactivated, all acquisition history and dossiers will be permanently purged.</p>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('profile.delete-user-form', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-902262906-2', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/livewire/pages/profile.blade.php ENDPATH**/ ?>