<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

?>

<div class="min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-14">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-2 h-2 rounded-full bg-sentry-light animate-pulse"></div>
                <span class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-80">Command Center</span>
            </div>
            <h1 class="font-display text-5xl md:text-6xl font-bold text-white leading-tight">
                Mission Control
            </h1>
            <p class="mt-3 text-sentry-light opacity-60 text-base max-w-xl">
                Real-time overview of the Riftbound marketplace. All sectors operational.
            </p>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-14">
            <div class="relative bg-sentry-darker border border-sentry-border rounded-xl p-6 shadow-[0_10px_40px_rgba(0,0,0,0.3)] overflow-hidden group hover:border-sentry-light/40 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-sentry-light/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <p class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50 mb-3">Total Revenue</p>
                    <p class="font-mono text-3xl font-bold text-sentry-light">€<?php echo e(number_format($this->stats['total_sales'], 2)); ?></p>
                    <p class="font-mono text-[10px] text-sentry-light opacity-30 mt-2">all confirmed orders</p>
                </div>
            </div>
            <div class="relative bg-sentry-darker border border-sentry-border rounded-xl p-6 shadow-[0_10px_40px_rgba(0,0,0,0.3)] overflow-hidden group hover:border-sentry-purple/40 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-sentry-purple/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <p class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50 mb-3">Total Orders</p>
                    <p class="font-mono text-3xl font-bold text-white"><?php echo e($this->stats['order_count']); ?></p>
                    <p class="font-mono text-[10px] text-sentry-light opacity-30 mt-2">across all statuses</p>
                </div>
            </div>
            <div class="relative bg-sentry-darker border border-sentry-border rounded-xl p-6 shadow-[0_10px_40px_rgba(0,0,0,0.3)] overflow-hidden group hover:border-sentry-light/20 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-sentry-light/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <p class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50 mb-3">Active Cards</p>
                    <p class="font-mono text-3xl font-bold text-white"><?php echo e($this->stats['product_count']); ?></p>
                    <p class="font-mono text-[10px] text-sentry-light opacity-30 mt-2">in the marketplace</p>
                </div>
            </div>
            <div class="relative bg-sentry-darker border border-sentry-border rounded-xl p-6 shadow-[0_10px_40px_rgba(0,0,0,0.3)] overflow-hidden group hover:border-sentry-coral/20 transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-br from-sentry-coral/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative z-10">
                    <p class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50 mb-3">Collectors</p>
                    <p class="font-mono text-3xl font-bold text-white"><?php echo e($this->stats['user_count']); ?></p>
                    <p class="font-mono text-[10px] text-sentry-light opacity-30 mt-2">registered accounts</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="flex justify-between items-center mb-5">
                    <h2 class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-70">Recent Acquisitions</h2>
                    <a href="<?php echo e(route('admin.orders.index')); ?>" wire:navigate class="font-mono text-[10px] uppercase tracking-widest text-sentry-light hover:text-white transition-colors flex items-center gap-1">
                        View All
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
                <div class="bg-sentry-darker border border-sentry-border rounded-xl overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.3)]">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-sentry-border bg-sentry-deep/60">
                                <th class="px-5 py-3 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Reference</th>
                                <th class="px-5 py-3 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Client</th>
                                <th class="px-5 py-3 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Value</th>
                                <th class="px-5 py-3 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Status</th>
                                <th class="px-5 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sentry-border/50">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->stats['recent_orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="group hover:bg-sentry-purple/5 transition-colors duration-150">
                                    <td class="px-5 py-4 font-mono text-xs text-sentry-light/70 tracking-wider"><?php echo e($order->order_number); ?></td>
                                    <td class="px-5 py-4 text-sm text-white/80"><?php echo e($order->billing_name); ?></td>
                                    <td class="px-5 py-4 font-mono text-sm font-bold text-sentry-light">€<?php echo e(number_format($order->total_amount, 2)); ?></td>
                                    <td class="px-5 py-4">
                                        <?php
                                            $statusColors = ['paid' => 'text-sentry-light border-sentry-light/30 bg-sentry-light/10', 'shipped' => 'text-sentry-light border-sentry-light/30 bg-sentry-light/5', 'pending' => 'text-sentry-coral border-sentry-coral/30 bg-sentry-coral/10', 'completed' => 'text-sentry-purple border-sentry-purple/30 bg-sentry-purple/10', 'cancelled' => 'text-red-500 border-red-500/50 bg-red-500/20'];
                                            $color = $statusColors[$order->status->value] ?? 'text-sentry-light border-sentry-border';
                                        ?>
                                        <span class="font-mono text-[9px] uppercase tracking-[2px] px-2.5 py-1 rounded-full border <?php echo e($color); ?>">
                                            <?php echo e($order->status->value); ?>

                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="<?php echo e(route('admin.orders.show', $order)); ?>" wire:navigate class="text-sentry-border group-hover:text-sentry-light transition-colors">
                                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <h2 class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-70 mb-5">Management Ops</h2>
                <div class="space-y-4">
                    <a href="<?php echo e(route('admin.products.create')); ?>" wire:navigate class="group block relative bg-sentry-darker border border-sentry-border rounded-xl p-5 hover:border-sentry-light/50 transition-all duration-300 overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.2)]">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-sentry-light/5 rounded-full blur-xl group-hover:bg-sentry-light/15 transition-all duration-500 -translate-y-1/2 translate-x-1/2"></div>
                        <div class="relative">
                            <div class="w-8 h-8 rounded-lg bg-sentry-light/10 border border-sentry-light/20 flex items-center justify-center mb-3 group-hover:bg-sentry-light/20 transition-colors">
                                <svg class="w-4 h-4 text-sentry-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <h3 class="font-bold text-white mb-1 group-hover:text-sentry-light transition-colors">Deploy New Card</h3>
                            <p class="text-[11px] text-sentry-light opacity-40">Add a new card to the marketplace.</p>
                        </div>
                    </a>
                    <a href="<?php echo e(route('admin.products.index')); ?>" wire:navigate class="group block relative bg-sentry-darker border border-sentry-border rounded-xl p-5 hover:border-sentry-purple/50 transition-all duration-300 overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.2)]">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-sentry-purple/5 rounded-full blur-xl group-hover:bg-sentry-purple/15 transition-all duration-500 -translate-y-1/2 translate-x-1/2"></div>
                        <div class="relative">
                            <div class="w-8 h-8 rounded-lg bg-sentry-purple/10 border border-sentry-purple/20 flex items-center justify-center mb-3 group-hover:bg-sentry-purple/20 transition-colors">
                                <svg class="w-4 h-4 text-sentry-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            </div>
                            <h3 class="font-bold text-white mb-1 group-hover:text-sentry-light transition-colors">Card Inventory</h3>
                            <p class="text-[11px] text-sentry-light opacity-40">Manage existing cards and pricing.</p>
                        </div>
                    </a>
                    <a href="<?php echo e(route('admin.categories.index')); ?>" wire:navigate class="group block relative bg-sentry-darker border border-sentry-border rounded-xl p-5 hover:border-sentry-light/20 transition-all duration-300 overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.2)]">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-sentry-light/5 rounded-full blur-xl group-hover:bg-sentry-light/10 transition-all duration-500 -translate-y-1/2 translate-x-1/2"></div>
                        <div class="relative">
                            <div class="w-8 h-8 rounded-lg bg-sentry-light/10 border border-sentry-light/20 flex items-center justify-center mb-3 group-hover:bg-sentry-light/20 transition-colors">
                                <svg class="w-4 h-4 text-sentry-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </div>
                            <h3 class="font-bold text-white mb-1 group-hover:text-sentry-light transition-colors">Manage Factions</h3>
                            <p class="text-[11px] text-sentry-light opacity-40">Control faction categories.</p>
                        </div>
                    </a>
                    <a href="<?php echo e(route('admin.orders.index')); ?>" wire:navigate class="group block relative bg-sentry-darker border border-sentry-border rounded-xl p-5 hover:border-sentry-coral/30 transition-all duration-300 overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.2)]">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-sentry-coral/5 rounded-full blur-xl group-hover:bg-sentry-coral/10 transition-all duration-500 -translate-y-1/2 translate-x-1/2"></div>
                        <div class="relative">
                            <div class="w-8 h-8 rounded-lg bg-sentry-coral/10 border border-sentry-coral/20 flex items-center justify-center mb-3 group-hover:bg-sentry-coral/20 transition-colors">
                                <svg class="w-4 h-4 text-sentry-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <h3 class="font-bold text-white mb-1 group-hover:text-sentry-coral transition-colors">Acquisition Log</h3>
                            <p class="text-[11px] text-sentry-light opacity-40">Review and manage all orders.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/livewire/pages/admin/dashboard.blade.php ENDPATH**/ ?>