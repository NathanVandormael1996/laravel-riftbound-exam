<?php

use Livewire\Volt\Component;

?>

<div 
    x-data="{ notifications: <?php if ((object) ('notifications') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('notifications'->value()); ?>')<?php echo e('notifications'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('notifications'); ?>')<?php endif; ?> }"
    class="fixed bottom-8 right-8 z-[100] flex flex-col space-y-4 pointer-events-none"
>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div 
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => { show = false; $wire.removeNotification('<?php echo e($id); ?>') }, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-2 opacity-0 scale-95"
            x-transition:enter-end="translate-y-0 opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="pointer-events-auto sentry-glass p-4 min-w-[320px] flex items-center space-x-4 shadow-2xl border-l-4 <?php echo e($notif['type'] === 'success' ? 'border-l-sentry-light' : 'border-l-sentry-pink'); ?>"
        >
            <div class="flex-shrink-0">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notif['type'] === 'success'): ?>
                    <svg class="w-6 h-6 text-sentry-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php else: ?>
                    <svg class="w-6 h-6 text-sentry-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="flex-grow">
                <div class="sentry-label text-[8px] opacity-50 mb-0.5">Notification</div>
                <div class="text-sm font-medium text-white"><?php echo e($notif['message']); ?></div>
            </div>
            <button @click="show = false" class="text-sentry-muted hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/livewire/support/notification.blade.php ENDPATH**/ ?>