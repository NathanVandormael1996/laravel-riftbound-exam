<?php

use App\Livewire\Actions\Logout;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;

?>

<nav x-data="{ open: false }" class="bg-sentry-darker border-b border-sentry-border sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" wire:navigate class="flex items-center space-x-3">
                        <img src="https://gamingdna.co.nz/cdn/shop/files/da447dd2-f720-43f5-b26b-f8b9b9bc1849-1761375941496_28aff86c-6f3e-4622-a5d0-67779406b921_1024x.webp?v=1773733223" alt="Riftbound Logo" class="h-10 w-auto object-contain drop-shadow-[0_0_15px_rgba(208,191,255,0.5)]">
                        <span class="font-display text-2xl font-bold tracking-tight text-white">Riftbound</span>
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="/" wire:navigate class="sentry-label hover:text-white transition-colors <?php echo e(request()->is('/') ? 'text-white border-b-2 border-sentry-light pb-1' : ''); ?>">
                        Shop
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" wire:navigate class="sentry-label hover:text-white transition-colors <?php echo e(request()->routeIs('dashboard') ? 'text-white border-b-2 border-sentry-light pb-1' : ''); ?>">
                            Dashboard
                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === \App\Enums\UserRole::ADMIN): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" wire:navigate class="sentry-label hover:text-sentry-light transition-colors flex items-center gap-1 <?php echo e(request()->routeIs('admin.*') ? 'text-sentry-light border-b-2 border-sentry-light pb-1' : ''); ?>">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                Command Center
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- Collection Basket Link -->
                <a href="<?php echo e(route('cart.index')); ?>" wire:navigate class="relative p-2 text-sentry-light hover:text-white transition-colors group">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->cartCount > 0): ?>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-[10px] font-bold leading-none text-sentry-deep transform translate-x-1/2 -translate-y-1/2 bg-sentry-light rounded-full shadow-lg group-hover:scale-110 transition-transform">
                            <?php echo e($this->cartCount); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <div class="text-sm font-medium text-white"><?php echo e(auth()->user()->name); ?></div>
                            <div class="text-xs text-sentry-light opacity-70 uppercase tracking-widest"><?php echo e(auth()->user()->role); ?></div>
                        </div>
                        <button wire:click="logout" class="btn-sentry-primary px-4 py-2 text-xs">
                            Logout
                        </button>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" wire:navigate class="btn-sentry-white px-6 py-2 text-xs">
                        Login
                    </a>
                    <a href="<?php echo e(route('register')); ?>" wire:navigate class="btn-sentry-primary px-6 py-2 text-xs">
                        Register
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-sentry-light hover:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-sentry-darker border-t border-sentry-border">
        <div class="pt-2 pb-3 space-y-1">
            <a href="/" wire:navigate class="block px-4 py-3 sentry-label hover:bg-sentry-deep">Shop</a>
            <a href="<?php echo e(route('cart.index')); ?>" wire:navigate class="block px-4 py-3 sentry-label hover:bg-sentry-deep flex justify-between items-center">
                <span>Basket</span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->cartCount > 0): ?>
                    <span class="bg-sentry-light text-sentry-deep px-2 py-0.5 rounded-full text-[10px] font-bold"><?php echo e($this->cartCount); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('dashboard')); ?>" wire:navigate class="block px-4 py-3 sentry-label hover:bg-sentry-deep">Dashboard</a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === \App\Enums\UserRole::ADMIN): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" wire:navigate class="block px-4 py-3 sentry-label text-sentry-light hover:bg-sentry-deep">⚙ Command Center</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div class="pt-4 pb-1 border-t border-sentry-border">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <div class="px-4 py-3">
                    <div class="text-base font-medium text-white"><?php echo e(auth()->user()->name); ?></div>
                    <div class="text-sm text-sentry-light"><?php echo e(auth()->user()->email); ?></div>
                </div>
                <div class="mt-3 space-y-1">
                    <button wire:click="logout" class="block w-full text-left px-4 py-3 sentry-label hover:bg-sentry-deep">Logout</button>
                </div>
            <?php else: ?>
                <div class="p-4 space-y-2">
                    <a href="<?php echo e(route('login')); ?>" wire:navigate class="block w-full text-center btn-sentry-white py-3">Login</a>
                    <a href="<?php echo e(route('register')); ?>" wire:navigate class="block w-full text-center btn-sentry-primary py-3">Register</a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</nav><?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/livewire/layout/navigation.blade.php ENDPATH**/ ?>