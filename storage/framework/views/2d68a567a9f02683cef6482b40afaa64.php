<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- User Profile Sidebar -->
                <aside class="w-full md:w-80 shrink-0 space-y-8">
                    <div class="sentry-card p-8 text-center relative overflow-hidden group">
                        <!-- Decorative glow -->
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-sentry-purple/20 rounded-full blur-[60px] group-hover:bg-sentry-purple/40 transition-all duration-500"></div>
                        
                        <div class="relative z-10 space-y-4">
                            <div class="w-24 h-24 bg-sentry-darker border-2 border-sentry-purple rounded-full mx-auto flex items-center justify-center text-3xl font-display font-bold text-sentry-light shadow-xl shadow-sentry-purple/10">
                                <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white"><?php echo e(auth()->user()->name); ?></h2>
                                <p class="sentry-label opacity-60"><?php echo e(auth()->user()->role->value); ?></p>
                            </div>
                            <div class="pt-4 flex justify-center space-x-4">
                                <div class="text-center">
                                    <div class="text-xl font-mono font-bold text-sentry-light"><?php echo e(auth()->user()->orders()->count()); ?></div>
                                    <div class="text-[8px] sentry-label opacity-40">Orders</div>
                                </div>
                                <div class="w-[1px] bg-sentry-border h-8 mt-2"></div>
                                <div class="text-center">
                                    <div class="text-xl font-mono font-bold text-sentry-pink">0</div>
                                    <div class="text-[8px] sentry-label opacity-40">Cards</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav class="sentry-glass p-2 space-y-1">
                        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-sentry-purple/10 text-sentry-light border-l-2 border-sentry-purple transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span class="font-medium">Overview</span>
                        </a>
                        <a href="<?php echo e(route('orders.index')); ?>" wire:navigate class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-sentry-deep text-sentry-muted hover:text-sentry-light transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <span class="font-medium">My Orders</span>
                        </a>
                        <a href="<?php echo e(route('profile')); ?>" wire:navigate class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-sentry-deep text-sentry-muted hover:text-sentry-light transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="font-medium">Identity Settings</span>
                        </a>
                    </nav>
                </aside>

                <!-- Main Content Area -->
                <div class="flex-grow space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="sentry-card p-8 bg-gradient-to-br from-sentry-deep to-sentry-darker relative group overflow-hidden">
                            <div class="relative z-10 space-y-4">
                                <div class="sentry-label">Market Status</div>
                                <h3 class="text-3xl font-bold text-white">Continue Shopping</h3>
                                <p class="text-sentry-light opacity-60 text-sm">New Noxian reinforcements have just arrived in the marketplace.</p>
                                <div class="pt-2">
                                    <a href="/" wire:navigate class="btn-sentry-primary px-6 py-3 text-xs inline-flex">Explore Cards</a>
                                </div>
                            </div>
                            <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-sentry-purple/10 rounded-full blur-[80px]"></div>
                        </div>

                        <div class="sentry-card p-8 border-sentry-pink/30 group">
                            <div class="space-y-4">
                                <div class="sentry-label text-sentry-pink">Recent Activity</div>
                                <h3 class="text-3xl font-bold text-white">Recent Orders</h3>
                                <?php $recentOrders = auth()->user()->orders()->latest()->take(3)->get(); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recentOrders->isEmpty()): ?>
                                    <p class="text-sentry-light opacity-60 text-sm italic">No recent order history found in your dossier.</p>
                                <?php else: ?>
                                    <div class="space-y-3 pt-2">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="flex justify-between items-center p-3 rounded bg-sentry-darker/50 border border-sentry-border/30">
                                                <div class="text-xs font-mono">#<?php echo e($order->order_number); ?></div>
                                                <div class="text-xs uppercase tracking-widest font-bold <?php echo e($order->status->value === 'completed' ? 'text-green-400' : 'text-sentry-coral'); ?>">
                                                    <?php echo e($order->status->value); ?>

                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="sentry-glass p-8">
                        <h3 class="font-display text-2xl font-bold mb-6">Identity Verification Status</h3>
                        <div class="flex items-center space-x-4 p-4 rounded-lg bg-green-500/10 border border-green-500/20">
                            <div class="p-2 rounded-full bg-green-500/20">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <div class="font-bold text-white">Authenticated</div>
                                <div class="text-xs text-sentry-light opacity-60">Your access codes are valid and your identity is confirmed.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/dashboard.blade.php ENDPATH**/ ?>