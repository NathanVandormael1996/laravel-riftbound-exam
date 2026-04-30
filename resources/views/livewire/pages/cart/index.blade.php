<?php


use App\Services\CartService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    #[Computed]
    public function cart()
    {
        return app(CartService::class)->getCart()->load('items.product');
    }

    public function increment(int $productId)
    {
        try {
            app(CartService::class)->updateQuantity($productId, $this->cart->items->firstWhere('product_id', $productId)->quantity + 1);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function decrement(int $productId)
    {
        app(CartService::class)->updateQuantity($productId, $this->cart->items->firstWhere('product_id', $productId)->quantity - 1);
    }

    public function remove(int $productId)
    {
        app(CartService::class)->removeItem($productId);
    }
}; ?>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl font-bold mb-8">Collection Basket</h1>

        @if($this->cart->items->isEmpty())
            <div class="sentry-glass p-12 text-center">
                <div class="text-sentry-light text-4xl mb-4 font-display">Basket is empty</div>
                <p class="text-sentry-light mb-8">You haven't added any cards to your collection yet.</p>
                <a href="/" wire:navigate class="btn-sentry-white px-8 py-3">Browse Marketplace</a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Items List -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($this->cart->items as $item)
                        <div class="sentry-card flex items-center p-4 gap-6">
                            <div class="w-20 h-24 bg-sentry-deep rounded overflow-hidden flex-shrink-0">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-sentry-border">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-grow">
                                <div class="sentry-label text-[10px] opacity-50">{{ $item->product->category->name }}</div>
                                <h3 class="text-lg font-bold">{{ $item->product->name }}</h3>
                                <div class="text-sentry-light font-mono">€{{ number_format($item->product->price, 2) }}</div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <button wire:click="decrement({{ $item->product_id }})" class="w-8 h-8 rounded border border-sentry-border flex items-center justify-center hover:bg-sentry-darker transition-colors">-</button>
                                <span class="font-mono w-4 text-center">{{ $item->quantity }}</span>
                                <button wire:click="increment({{ $item->product_id }})" class="w-8 h-8 rounded border border-sentry-border flex items-center justify-center hover:bg-sentry-darker transition-colors">+</button>
                            </div>

                            <div class="text-right min-w-[100px]">
                                <div class="text-lg font-mono font-bold">€{{ number_format($item->subtotal, 2) }}</div>
                                <button wire:click="remove({{ $item->product_id }})" class="text-[10px] uppercase tracking-widest text-sentry-pink hover:underline">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary -->
                <aside class="space-y-6">
                    <div class="sentry-card p-6 space-y-6">
                        <h2 class="sentry-label">Order Summary</h2>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between text-sentry-light opacity-60">
                                <span>Subtotal</span>
                                <span>€{{ number_format($this->cart->total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sentry-light opacity-60">
                                <span>Processing Fee</span>
                                <span>€0.00</span>
                            </div>
                            <div class="border-t border-sentry-border pt-4 flex justify-between items-end">
                                <span class="text-xl font-bold uppercase tracking-tight">Total</span>
                                <span class="text-3xl font-mono font-bold text-sentry-light">€{{ number_format($this->cart->total, 2) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" wire:navigate class="w-full btn-sentry-primary py-4 block text-center">
                            Initiate Checkout
                        </a>
                    </div>

                    <div class="sentry-glass p-4 text-xs text-sentry-light opacity-60 italic">
                        Prices include regional taxes where applicable. Card availability is not guaranteed until checkout is complete.
                    </div>
                </aside>
            </div>
        @endif
    </div>
</div>
