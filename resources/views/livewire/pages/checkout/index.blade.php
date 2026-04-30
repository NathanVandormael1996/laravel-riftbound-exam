<?php
use App\Actions\Orders\CreateOrderAction;
use App\Actions\Checkout\CreateCheckoutSessionAction;
use App\Services\CartService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
new #[Layout('layouts.app')] class extends Component
{
    public $billing_name = '';
    public $billing_email = '';
    public $billing_address = '';
    public $shipping_name = '';
    public $shipping_address = '';
    public function mount()
    {
        if (auth()->check()) {
            $this->billing_name = auth()->user()->name;
            $this->billing_email = auth()->user()->email;
        }
        if (app(CartService::class)->getCart()->items->isEmpty()) {
            return redirect()->route('cart.index');
        }
    }
    public function cart()
    {
        return app(CartService::class)->getCart()->load('items.product');
    }
    public function submit(CreateOrderAction $createOrder, CreateCheckoutSessionAction $createSession)
    {
        $this->validate();
        $order = $createOrder->handle($this->cart, [
            'billing_name' => $this->billing_name,
            'billing_email' => $this->billing_email,
            'billing_address' => $this->billing_address,
            'shipping_name' => $this->shipping_name ?: $this->billing_name,
            'shipping_address' => $this->shipping_address ?: $this->billing_address,
        ]);
        $redirectUrl = $createSession->handle($order);
        app(CartService::class)->clear();
        return redirect($redirectUrl);
    }
}; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl font-bold mb-8">Secure Checkout</h1>
        <form wire:submit="submit" class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Form Section -->
            <div class="lg:col-span-2 space-y-12">
                <section class="space-y-6">
                    <h2 class="sentry-label">Billing Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest opacity-60">Full Name</label>
                            <input wire:model="billing_name" type="text" class="sentry-input w-full @error('billing_name') border-sentry-pink @enderror">
                            @error('billing_name') <span class="text-sentry-pink text-[10px]">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest opacity-60">Email Address</label>
                            <input wire:model="billing_email" type="email" class="sentry-input w-full @error('billing_email') border-sentry-pink @enderror">
                            @error('billing_email') <span class="text-sentry-pink text-[10px]">{{ $message }}</span> @enderror
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-xs uppercase tracking-widest opacity-60">Billing Address</label>
                            <textarea wire:model="billing_address" rows="3" class="sentry-input w-full @error('billing_address') border-sentry-pink @enderror"></textarea>
                            @error('billing_address') <span class="text-sentry-pink text-[10px]">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </section>
                <section class="space-y-6">
                    <h2 class="sentry-label">Shipping Details (Optional)</h2>
                    <p class="text-xs text-sentry-light opacity-50 italic mb-4">Leave blank if same as billing.</p>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest opacity-60">Recipient Name</label>
                            <input wire:model="shipping_name" type="text" class="sentry-input w-full">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs uppercase tracking-widest opacity-60">Shipping Address</label>
                            <textarea wire:model="shipping_address" rows="3" class="sentry-input w-full"></textarea>
                        </div>
                    </div>
                </section>
            </div>
            <!-- Summary & Payment -->
            <aside class="space-y-6">
                <div class="sentry-card p-6 space-y-6">
                    <h2 class="sentry-label">Your Selection</h2>
                    <div class="space-y-4 max-h-60 overflow-y-auto pr-2">
                        @foreach($this->cart->items as $item)
                            <div class="flex justify-between items-center text-sm">
                                <div>
                                    <div class="font-bold">{{ $item->product->name }}</div>
                                    <div class="text-[10px] opacity-50">Qty: {{ $item->quantity }}</div>
                                </div>
                                <div class="font-mono">€{{ number_format($item->subtotal, 2) }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t border-sentry-border pt-4 space-y-2">
                        <div class="flex justify-between items-end">
                            <span class="text-sm font-bold uppercase tracking-tight">Order Total</span>
                            <span class="text-3xl font-mono font-bold text-sentry-light">€{{ number_format($this->cart->total, 2) }}</span>
                        </div>
                    </div>
                    <button type="submit" class="w-full btn-sentry-primary py-5 text-lg flex items-center justify-center space-x-3 group">
                        <span>Confirm & Pay</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    <div class="text-center flex items-center justify-center space-x-2 text-sentry-light opacity-50 hover:opacity-100 transition-all cursor-default">
                        <span class="text-[10px] uppercase tracking-[2px] font-bold">Powered by</span>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg" alt="Stripe" class="h-4 filter brightness-0 invert">
                    </div>
                </div>
                <div class="sentry-glass p-4">
                    <div class="flex items-start space-x-3">
                        <div class="text-sentry-light">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div class="text-[10px] text-sentry-light opacity-60">
                            Your transaction is secured with 256-bit SSL encryption. We do not store your full card details.
                        </div>
                    </div>
                </div>
            </aside>
        </form>
    </div>
</div>
