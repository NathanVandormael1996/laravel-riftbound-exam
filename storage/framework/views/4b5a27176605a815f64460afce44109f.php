<?php

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h1 class="font-display text-4xl font-bold text-white mb-2">Acquisition History</h1>
            <p class="text-sentry-light opacity-60 uppercase tracking-[2px] text-xs">All deployments to your collection</p>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->orders->isEmpty()): ?>
            <div class="sentry-glass p-16 text-center">
                <div class="w-20 h-20 bg-sentry-deep border border-sentry-border rounded-full mx-auto flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-sentry-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-4">No data found in your dossier</h2>
                <p class="text-sentry-light opacity-70 mb-8 max-w-md mx-auto">Your collection is currently empty. Visit the marketplace to acquire new reinforcements.</p>
                <a href="/" wire:navigate class="btn-sentry-primary px-8 py-3 inline-block">Visit Marketplace</a>
            </div>
        <?php else: ?>
            <div class="space-y-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="sentry-card overflow-hidden group">
                        <div class="p-6 md:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <span class="font-mono text-sm font-bold text-sentry-light tracking-wider"><?php echo e($order->order_number); ?></span>
                                    <span class="sentry-badge <?php echo e($order->status->value === 'paid' ? 'border-green-500/30 text-green-400 bg-green-500/5' : 'border-sentry-purple/30 text-sentry-purple bg-sentry-purple/5'); ?>">
                                        <?php echo e($order->status->value); ?>

                                    </span>
                                </div>
                                <div class="flex items-center gap-6">
                                    <div>
                                        <p class="sentry-label text-[9px] opacity-40">Deployment Date</p>
                                        <p class="text-sm font-medium text-white"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                                    </div>
                                    <div class="w-[1px] h-8 bg-sentry-border"></div>
                                    <div>
                                        <p class="sentry-label text-[9px] opacity-40">Value</p>
                                        <p class="text-sm font-mono font-bold text-white">€<?php echo e(number_format($order->total_amount, 2)); ?></p>
                                    </div>
                                    <div class="w-[1px] h-8 bg-sentry-border"></div>
                                    <div>
                                        <p class="sentry-label text-[9px] opacity-40">Items</p>
                                        <p class="text-sm font-medium text-white"><?php echo e($order->items->sum('quantity')); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="<?php echo e(route('orders.show', $order)); ?>" wire:navigate class="btn-sentry-secondary px-6 py-2 text-xs">
                                    View Dossier
                                </a>
                            </div>
                        </div>
                        <!-- Mini items preview -->
                        <div class="bg-sentry-darker/50 border-t border-sentry-border px-6 py-4 flex gap-4 overflow-x-auto">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex-shrink-0 flex items-center gap-3 bg-sentry-deep/40 p-2 rounded border border-sentry-border/50">
                                    <div class="w-8 h-10 bg-sentry-darker rounded overflow-hidden">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product && $item->product->image): ?>
                                            <img src="<?php echo e($item->product->image); ?>" alt="" class="w-full h-full object-cover">
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <div class="text-[10px] font-bold text-sentry-light max-w-[100px] truncate">
                                        <?php echo e($item->product_name_snapshot); ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->items->count() > 5): ?>
                                <div class="flex-shrink-0 flex items-center justify-center w-8 h-10 bg-sentry-deep/40 rounded border border-sentry-border/50 text-[10px] font-bold text-sentry-muted">
                                    +<?php echo e($order->items->count() - 5); ?>

                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div><?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/livewire/pages/orders/index.blade.php ENDPATH**/ ?>