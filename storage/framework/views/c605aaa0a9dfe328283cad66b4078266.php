<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

?>

<div class="min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" wire:navigate class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40 hover:opacity-80 transition-opacity">Command Center</a>
                    <span class="text-sentry-border">/</span>
                    <span class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-80">Card Inventory</span>
                </div>
                <h1 class="font-display text-5xl font-bold text-white">Card Inventory</h1>
                <p class="mt-2 text-sentry-light opacity-50 text-sm">Deploy, manage and deactivate cards across all factions.</p>
            </div>
            <a href="<?php echo e(route('admin.products.create')); ?>" wire:navigate
               class="shrink-0 bg-sentry-light text-sentry-deep font-mono text-[13px] font-bold uppercase tracking-[1.5px] px-7 py-3 rounded-[13px] shadow-[inset_0_1px_3px_rgba(0,0,0,0.1)] hover:shadow-[0_0.5rem_1.5rem_rgba(208,191,255,0.3)] transition-all duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Deploy Card
            </a>
        </div>
        <div class="relative mb-6 max-w-sm">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-sentry-light opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input wire:model.live.debounce.300ms="search"
                   type="text"
                   placeholder="Search cards..."
                   class="w-full bg-sentry-darker border border-sentry-border text-white placeholder-sentry-light/30 rounded-xl pl-11 pr-4 py-3 font-mono text-sm focus:outline-none focus:border-sentry-purple/60 focus:ring-1 focus:ring-sentry-purple/30 transition-colors">
        </div>
        <div class="bg-sentry-darker border border-sentry-border rounded-xl overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.4)]">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-sentry-border bg-sentry-deep/60">
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Card</th>
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Faction</th>
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Price</th>
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Stock</th>
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Status</th>
                        <th class="px-6 py-4 text-right font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sentry-border/40">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="group hover:bg-sentry-purple/5 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-white group-hover:text-sentry-light transition-colors"><?php echo e($product->name); ?></div>
                                <div class="font-mono text-[10px] text-sentry-light opacity-30 mt-0.5 tracking-wider"><?php echo e($product->slug); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-mono text-[11px] text-sentry-light opacity-60"><?php echo e($product->category->name); ?></span>
                            </td>
                            <td class="px-6 py-4 font-mono text-sm font-bold text-sentry-light">€<?php echo e(number_format($product->price, 2)); ?></td>
                            <td class="px-6 py-4 font-mono text-sm <?php echo e($product->stock < 10 ? 'text-sentry-pink' : 'text-sentry-light opacity-70'); ?>">
                                <?php echo e($product->stock); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->stock < 10): ?>
                                    <span class="ml-1 font-mono text-[9px] text-sentry-pink opacity-70">low</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_active): ?>
                                    <span class="font-mono text-[9px] uppercase tracking-[2px] px-2.5 py-1 rounded-full border border-sentry-light/30 bg-sentry-light/10 text-sentry-light">Active</span>
                                <?php else: ?>
                                    <span class="font-mono text-[9px] uppercase tracking-[2px] px-2.5 py-1 rounded-full border border-sentry-border bg-sentry-deep/60 text-sentry-light opacity-40">Draft</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="<?php echo e(route('admin.products.edit', $product)); ?>" wire:navigate
                                       class="p-2 rounded-lg border border-sentry-border text-sentry-light opacity-40 hover:opacity-100 hover:border-sentry-purple/50 hover:text-sentry-light hover:bg-sentry-purple/10 transition-all duration-150">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button wire:click="deleteProduct(<?php echo e($product->id); ?>)"
                                            wire:confirm="Delete '<?php echo e($product->name); ?>'? This cannot be undone."
                                            class="p-2 rounded-lg border border-sentry-border text-sentry-light opacity-30 hover:opacity-100 hover:border-sentry-pink/40 hover:text-sentry-pink hover:bg-sentry-pink/10 transition-all duration-150">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <p class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-30">No cards found</p>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->products->hasPages()): ?>
                <div class="px-6 py-4 border-t border-sentry-border/50 bg-sentry-deep/30">
                    <?php echo e($this->products->links()); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/livewire/pages/admin/products/index.blade.php ENDPATH**/ ?>