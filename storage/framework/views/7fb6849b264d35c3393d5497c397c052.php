<?php
    $isEdit = isset($form->product) && $form->product !== null;
    $title = $isEdit ? 'Edit Card: ' . $form->name : 'Deploy New Card';
    $subtitle = $isEdit ? 'Update card details, pricing and availability.' : 'Add a new card to the Riftbound marketplace.';
    $action = $isEdit ? 'Update Card' : 'Deploy to Marketplace';
?>
<div class="min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <div class="flex items-center gap-2 mb-4">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-30 hover:opacity-70 transition-opacity">Command Center</a>
                <span class="text-sentry-border">/</span>
                <a href="<?php echo e(route('admin.products.index')); ?>" class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-30 hover:opacity-70 transition-opacity">Inventory</a>
                <span class="text-sentry-border">/</span>
                <span class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-80"><?php echo e($isEdit ? 'Edit' : 'New'); ?></span>
            </div>
            <h1 class="font-display text-5xl font-bold text-white"><?php echo e($title); ?></h1>
            <p class="mt-2 text-sentry-light opacity-50 text-sm"><?php echo e($subtitle); ?></p>
        </div>
        <form wire:submit="save" class="space-y-6">
            <div class="bg-sentry-darker border border-sentry-border rounded-xl overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.4)]">
                <div class="px-6 py-4 border-b border-sentry-border/50 bg-sentry-deep/40 flex items-center gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-sentry-light"></div>
                    <h2 class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-60">Core Details</h2>
                </div>
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">Card Name</label>
                            <input wire:model="form.name" type="text"
                                   class="w-full bg-sentry-deep border border-sentry-border rounded-xl px-4 py-3 text-white placeholder-sentry-light/20 font-sans text-sm focus:outline-none focus:border-sentry-purple/60 focus:ring-1 focus:ring-sentry-purple/30 transition-colors <?php $__errorArgs = ['form.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-sentry-pink/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="e.g. Noxian Might">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="font-mono text-[10px] text-sentry-pink"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-2">
                            <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">URL Slug</label>
                            <input wire:model="form.slug" type="text"
                                   class="w-full bg-sentry-deep border border-sentry-border rounded-xl px-4 py-3 text-sentry-light font-mono text-sm placeholder-sentry-light/20 focus:outline-none focus:border-sentry-purple/60 focus:ring-1 focus:ring-sentry-purple/30 transition-colors <?php $__errorArgs = ['form.slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-sentry-pink/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="noxian-might">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="font-mono text-[10px] text-sentry-pink"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">Lore & Description</label>
                        <textarea wire:model="form.description" rows="4"
                                  class="w-full bg-sentry-deep border border-sentry-border rounded-xl px-4 py-3 text-white placeholder-sentry-light/20 font-sans text-sm leading-relaxed focus:outline-none focus:border-sentry-purple/60 focus:ring-1 focus:ring-sentry-purple/30 transition-colors resize-none <?php $__errorArgs = ['form.description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-sentry-pink/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  placeholder="The strength of Noxus lies not in the size of its army..."></textarea>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="font-mono text-[10px] text-sentry-pink"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="space-y-2">
                        <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">Card Image</label>
                        <input wire:model="form.newImage" type="file"
                               class="w-full bg-sentry-deep border border-sentry-border rounded-xl px-4 py-3 text-white font-sans text-sm focus:outline-none focus:border-sentry-purple/60 focus:ring-1 focus:ring-sentry-purple/30 transition-colors <?php $__errorArgs = ['form.newImage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-sentry-pink/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.newImage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="font-mono text-[10px] text-sentry-pink"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($form->newImage): ?>
                            <div class="mt-2">
                                <span class="text-xs text-sentry-light">Image preview available</span>
                            </div>
                        <?php elseif($isEdit && $form->product->image): ?>
                            <div class="mt-2">
                                <span class="text-xs text-sentry-light opacity-60">Current image: <?php echo e(basename($form->product->image)); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="bg-sentry-darker border border-sentry-border rounded-xl overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.4)]">
                <div class="px-6 py-4 border-b border-sentry-border/50 bg-sentry-deep/40 flex items-center gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-sentry-light"></div>
                    <h2 class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-60">Pricing & Inventory</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="space-y-2">
                            <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">Price (€)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-mono text-sentry-light font-bold">€</span>
                                <input wire:model="form.price" type="number" step="0.01"
                                       class="w-full bg-sentry-deep border border-sentry-border rounded-xl pl-8 pr-4 py-3 text-sentry-light font-mono text-sm font-bold focus:outline-none focus:border-sentry-light/40 focus:ring-1 focus:ring-sentry-light/20 transition-colors <?php $__errorArgs = ['form.price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-sentry-pink/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="font-mono text-[10px] text-sentry-pink"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-2">
                            <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">Stock</label>
                            <input wire:model="form.stock" type="number"
                                   class="w-full bg-sentry-deep border border-sentry-border rounded-xl px-4 py-3 text-white font-mono text-sm focus:outline-none focus:border-sentry-purple/60 focus:ring-1 focus:ring-sentry-purple/30 transition-colors <?php $__errorArgs = ['form.stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-sentry-pink/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="font-mono text-[10px] text-sentry-pink"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="space-y-2">
                            <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">Faction</label>
                            <select wire:model="form.category_id"
                                    class="w-full bg-sentry-deep border border-sentry-border rounded-xl px-4 py-3 text-white font-mono text-sm focus:outline-none focus:border-sentry-purple/60 focus:ring-1 focus:ring-sentry-purple/30 transition-colors <?php $__errorArgs = ['form.category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-sentry-pink/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Select Faction</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['form.category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="font-mono text-[10px] text-sentry-pink"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-sentry-darker border border-sentry-border rounded-xl overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.4)]">
                <div class="px-6 py-4 border-b border-sentry-border/50 bg-sentry-deep/40 flex items-center gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-sentry-purple"></div>
                    <h2 class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-60">Attributes</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-center">
                        <div class="space-y-2">
                            <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">Rarity Badge</label>
                            <select wire:model="form.badge"
                                    class="w-full bg-sentry-deep border border-sentry-border rounded-xl px-4 py-3 text-white font-mono text-sm focus:outline-none focus:border-sentry-purple/60 transition-colors">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $this->badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($badge->value); ?>"><?php echo e(ucfirst($badge->value)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>
                        <label class="flex items-center gap-3 cursor-pointer group pt-5">
                            <div class="relative">
                                <input wire:model="form.is_active" type="checkbox" id="is_active" class="sr-only peer">
                                <div class="w-10 h-5 bg-sentry-deep border border-sentry-border rounded-full peer-checked:bg-sentry-light/20 peer-checked:border-sentry-light/50 transition-all duration-200"></div>
                                <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-sentry-border rounded-full transition-all duration-200 peer-checked:translate-x-5 peer-checked:bg-sentry-light"></div>
                            </div>
                            <span class="font-mono text-[11px] uppercase tracking-[1.5px] text-sentry-light opacity-60 group-hover:opacity-100 transition-opacity">Active in Shop</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group pt-5">
                            <div class="relative">
                                <input wire:model="form.is_featured" type="checkbox" id="is_featured" class="sr-only peer">
                                <div class="w-10 h-5 bg-sentry-deep border border-sentry-border rounded-full peer-checked:bg-sentry-purple/30 peer-checked:border-sentry-purple/50 transition-all duration-200"></div>
                                <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-sentry-border rounded-full transition-all duration-200 peer-checked:translate-x-5 peer-checked:bg-sentry-purple"></div>
                            </div>
                            <span class="font-mono text-[11px] uppercase tracking-[1.5px] text-sentry-light opacity-60 group-hover:opacity-100 transition-opacity">Featured Card</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between pt-2">
                <a href="<?php echo e(route('admin.products.index')); ?>"
                   class="font-mono text-[11px] uppercase tracking-[2px] text-sentry-light opacity-40 hover:opacity-80 transition-opacity flex items-center gap-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Cancel
                </a>
                <button type="submit"
                        class="bg-sentry-light text-sentry-deep font-mono text-[13px] font-bold uppercase tracking-[1.5px] px-10 py-3.5 rounded-[13px] shadow-[inset_0_1px_3px_rgba(0,0,0,0.1)] hover:shadow-[0_0.5rem_1.5rem_rgba(208,191,255,0.3)] hover:scale-[1.02] transition-all duration-200">
                    <?php echo e($action); ?>

                </button>
            </div>
        </form>
    </div>
</div><?php /**PATH /srv/http/laravel-riftbound-exam/resources/views/livewire/pages/admin/products/_form.blade.php ENDPATH**/ ?>