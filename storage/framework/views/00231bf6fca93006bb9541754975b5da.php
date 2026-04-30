<?php

use App\Models\Order;
use App\Enums\OrderStatus;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

?>

<div class="min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-10">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <a href="<?php echo e(route('admin.orders.index')); ?>" class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-30 hover:opacity-70 transition-opacity">Acquisition Log</a>
                    <span class="text-sentry-border">/</span>
                    <span class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-80"><?php echo e($this->order->order_number); ?></span>
                </div>
                <h1 class="font-display text-5xl font-bold text-white">Order Details</h1>
                <p class="mt-2 font-mono text-sm text-sentry-light opacity-40 tracking-wider"><?php echo e($this->order->created_at->format('F j, Y — H:i')); ?></p>
            </div>

            
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40 mr-1">Status:</span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \App\Enums\OrderStatus::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isCurrent = $this->order->status === $s;
                            $colors = ['paid' => 'bg-sentry-light text-sentry-deep', 'pending' => 'bg-sentry-coral text-sentry-deep', 'shipped' => 'bg-sentry-purple text-white', 'completed' => 'bg-sentry-light text-sentry-deep', 'cancelled' => 'bg-red-500 text-white'];
                            $activeClass = $colors[$s->value] ?? 'bg-sentry-muted text-white';
                        ?>
                        <button type="button" 
                                wire:click="updateStatus('<?php echo e($s->value); ?>')"
                                class="font-mono text-[10px] uppercase tracking-[2px] px-3.5 py-2 rounded-full transition-all duration-200 <?php echo e($isCurrent ? $activeClass . ' shadow-[0_0_20px_rgba(0,0,0,0.3)]' : 'border border-sentry-border text-sentry-light opacity-30 hover:opacity-70'); ?>">
                            <?php echo e($s->value); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->order->status === \App\Enums\OrderStatus::PAID): ?>
                    <div class="h-8 w-[1px] bg-sentry-border mx-2"></div>
                    <button 
                        type="button"
                        wire:click="refundOrder" 
                        wire:loading.attr="disabled"
                        class="btn-sentry-primary bg-sentry-pink hover:bg-sentry-pink/80 px-6 py-2 text-[10px] uppercase tracking-[2px] shadow-[0_0_20px_rgba(240,111,151,0.2)] disabled:opacity-50"
                    >
                        <span wire:loading.remove>Refund Unit</span>
                        <span wire:loading>Processing...</span>
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            
            <div class="lg:col-span-2">
                <h2 class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-50 mb-5">Ordered Cards</h2>
                <div class="bg-sentry-darker border border-sentry-border rounded-xl overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.4)]">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-sentry-border bg-sentry-deep/60">
                                <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Card</th>
                                <th class="px-6 py-4 text-right font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Unit</th>
                                <th class="px-6 py-4 text-right font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Qty</th>
                                <th class="px-6 py-4 text-right font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sentry-border/40">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-sentry-purple/5 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-14 bg-sentry-deep rounded-lg overflow-hidden border border-sentry-border shrink-0 flex items-center justify-center">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product?->image): ?>
                                                    <img src="<?php echo e($item->product->image); ?>" class="w-full h-full object-cover" alt="<?php echo e($item->product_name_snapshot); ?>">
                                                <?php else: ?>
                                                    <svg class="w-5 h-5 text-sentry-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2-2v12a2 2 0 002 2z"/></svg>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-white text-sm"><?php echo e($item->product_name_snapshot); ?></div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product): ?>
                                                    <div class="font-mono text-[10px] text-sentry-light opacity-30 mt-0.5"><?php echo e($item->product->category->name); ?></div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-right font-mono text-sm text-sentry-light opacity-60">€<?php echo e(number_format($item->price_snapshot, 2)); ?></td>
                                    <td class="px-6 py-5 text-right font-mono text-sm text-sentry-light opacity-50">× <?php echo e($item->quantity); ?></td>
                                    <td class="px-6 py-5 text-right font-mono text-sm font-bold text-sentry-light">€<?php echo e(number_format($item->subtotal, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr class="border-t border-sentry-border bg-sentry-deep/30">
                                <td colspan="3" class="px-6 py-4 text-right font-mono text-[11px] uppercase tracking-[2px] text-sentry-light opacity-50">Order Total</td>
                                <td class="px-6 py-4 text-right font-mono text-2xl font-bold text-sentry-light">€<?php echo e(number_format($this->order->total_amount, 2)); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            
            <div class="space-y-5">

                
                <div>
                    <h2 class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-50 mb-4">Client Identity</h2>
                    <div class="bg-sentry-darker border border-sentry-border rounded-xl p-5 shadow-[0_10px_30px_rgba(0,0,0,0.3)] space-y-4">
                        <div>
                            <p class="font-mono text-[9px] uppercase tracking-[2px] text-sentry-light opacity-30 mb-1">Full Name</p>
                            <p class="text-white font-semibold"><?php echo e($this->order->billing_name); ?></p>
                        </div>
                        <div>
                            <p class="font-mono text-[9px] uppercase tracking-[2px] text-sentry-light opacity-30 mb-1">Email</p>
                            <p class="font-mono text-sm text-sentry-light opacity-70"><?php echo e($this->order->billing_email); ?></p>
                        </div>
                    </div>
                </div>

                
                <div>
                    <h2 class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-50 mb-4">Delivery Coordinates</h2>
                    <div class="bg-sentry-darker border border-sentry-border rounded-xl p-5 shadow-[0_10px_30px_rgba(0,0,0,0.3)] space-y-4">
                        <div>
                            <p class="font-mono text-[9px] uppercase tracking-[2px] text-sentry-light opacity-30 mb-1">Recipient</p>
                            <p class="text-white font-semibold"><?php echo e($this->order->shipping_name); ?></p>
                        </div>
                        <div>
                            <p class="font-mono text-[9px] uppercase tracking-[2px] text-sentry-light opacity-30 mb-1">Address</p>
                            <p class="font-mono text-sm text-sentry-light opacity-60 leading-relaxed whitespace-pre-line"><?php echo e($this->order->shipping_address); ?></p>
                        </div>
                    </div>
                </div>

                
                <div class="bg-sentry-darker border border-sentry-border rounded-xl p-5 shadow-[0_10px_30px_rgba(0,0,0,0.3)]">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="font-mono text-[9px] uppercase tracking-[2px] text-sentry-light opacity-30">Order Ref</span>
                            <span class="font-mono text-[11px] text-sentry-light opacity-60"><?php echo e($this->order->order_number); ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-mono text-[9px] uppercase tracking-[2px] text-sentry-light opacity-30">Placed</span>
                            <span class="font-mono text-[11px] text-sentry-light opacity-60"><?php echo e($this->order->created_at->diffForHumans()); ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/livewire/pages/admin/orders/show.blade.php ENDPATH**/ ?>