<?php

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <aside class="w-full md:w-64 shrink-0 space-y-8">
                <!-- Search -->
                <div class="space-y-3">
                    <label class="sentry-label text-xs">Search Cards</label>
                    <div class="relative">
                        <input 
                            wire:model.live.debounce.300ms="search" 
                            type="text" 
                            placeholder="e.g. Garen, Noxian Might..." 
                            class="sentry-input w-full pl-10"
                        >
                        <div class="absolute left-3 top-2.5 text-sentry-deep opacity-40">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>
                <!-- Categories -->
                <div class="space-y-3">
                    <label class="sentry-label text-xs">Factions</label>
                    <div class="flex flex-col space-y-2">
                        <button 
                            wire:click="$set('categorySlug', '')"
                            class="text-left px-3 py-2 rounded-md transition-colors <?php echo e(!$this->categorySlug ? 'bg-sentry-purple text-white' : 'text-sentry-light hover:bg-sentry-darker'); ?>"
                        >
                            All Factions
                        </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button 
                                wire:click="$set('categorySlug', '<?php echo e($category->slug); ?>')"
                                class="text-left px-3 py-2 rounded-md transition-colors <?php echo e($this->categorySlug === $category->slug ? 'bg-sentry-purple text-white' : 'text-sentry-light hover:bg-sentry-darker'); ?>"
                            >
                                <?php echo e($category->name); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->search || $this->categorySlug): ?>
                    <button 
                        wire:click="clearFilters" 
                        class="text-sentry-light text-xs uppercase font-bold tracking-widest hover:underline"
                    >
                        Clear Filters
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </aside>
            <!-- Main Content -->
            <div class="flex-grow">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h1 class="font-display text-4xl font-bold">Marketplace</h1>
                        <p class="text-sentry-light opacity-60">Discover the rarest cards from all factions.</p>
                    </div>
                    <div class="sentry-label text-xs">
                        Showing <?php echo e($this->products->firstItem() ?? 0); ?> - <?php echo e($this->products->lastItem() ?? 0); ?> of <?php echo e($this->products->total()); ?> results
                    </div>
                </div>
                <!-- Product Grid -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->products->isEmpty()): ?>
                    <div class="sentry-glass p-12 text-center">
                        <div class="text-sentry-light text-4xl mb-4 font-display">No cards found</div>
                        <p class="text-sentry-light">Try adjusting your filters or search terms.</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('shop.show', $product->slug)); ?>" wire:navigate class="sentry-card group hover:border-sentry-purple transition-all duration-300 hover:-translate-y-1">
                                <div class="aspect-[4/5] bg-sentry-deep relative overflow-hidden">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->image): ?>
                                        <img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-sentry-border group-hover:text-sentry-purple transition-colors">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <!-- Badge -->
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->badge->value !== 'none'): ?>
                                        <div class="absolute top-4 right-4 bg-sentry-deep/80 backdrop-blur px-3 py-1 rounded-full border border-sentry-border">
                                            <span class="text-[10px] uppercase font-bold tracking-widest <?php echo e($product->badge->value === 'legendary' ? 'text-sentry-light' : (
                                                $product->badge->value === 'epic' ? 'text-sentry-pink' : 'text-sentry-light'
                                                )); ?>">
                                                <?php echo e($product->badge->value); ?>

                                            </span>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="p-5 space-y-4">
                                    <div class="space-y-1">
                                        <div class="sentry-label text-[10px] opacity-50"><?php echo e($product->category->name); ?></div>
                                        <h3 class="text-xl font-bold group-hover:text-sentry-light transition-colors"><?php echo e($product->name); ?></h3>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="text-2xl font-mono font-bold text-sentry-light">
                                            €<?php echo e(number_format($product->price, 2)); ?>

                                        </div>
                                        <div class="btn-sentry-primary px-4 py-2 text-xs">
                                            View Details
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-12">
                        <?php echo e($this->products->links()); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/livewire/pages/shop/index.blade.php ENDPATH**/ ?>