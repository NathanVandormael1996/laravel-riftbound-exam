<?php


use App\Models\Order;
use App\Enums\OrderStatus;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order;
        
        // Authorization check: Only the owner of the order can see the success page
        if ($this->order->user_id && $this->order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to order dossier.');
        }

        // Retrieve and store Stripe details if present in the URL
        $sessionId = request()->query('session_id');
        if ($sessionId && !$this->order->stripe_payment_intent_id) {
            try {
                $stripeService = app(\App\Services\StripeService::class);
                $session = \Stripe\Checkout\Session::retrieve($sessionId);
                $this->order->update([
                    'stripe_session_id' => $sessionId,
                    'stripe_payment_intent_id' => $session->payment_intent,
                ]);
            } catch (\Exception $e) {
                // Silently fail if session retrieval fails in dev environment
                \Illuminate\Support\Facades\Log::warning('Stripe session retrieval failed: ' . $e->getMessage());
            }
        }

        // In a real implementation, we would verify the Stripe session here
        // and update the status. For now, we'll just mark it as PAID for demo purposes.
        if ($this->order->status === OrderStatus::PENDING) {
            $this->order->update(['status' => OrderStatus::PAID]);
            foreach ($this->order->items as $item) {
                if ($item->product) {
                    $item->product->decrement('stock', $item->quantity);
                }
            }
        }
    }
}; ?>

<div class="py-24">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-sentry-light rounded-full mb-8 shadow-[0_0_50px_rgba(208,191,255,0.3)]">
            <svg class="w-10 h-10 text-sentry-deep" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        </div>

        <h1 class="font-display text-5xl font-bold mb-4 tracking-tight">Order Confirmed</h1>
        <p class="text-sentry-light text-lg opacity-60 mb-12">Your rare cards are being prepared for deployment to your collection.</p>

        <div class="sentry-card p-8 bg-sentry-darker text-left space-y-6">
            <div class="flex justify-between items-center border-b border-sentry-border pb-4">
                <div class="sentry-label text-xs">Order Number</div>
                <div class="font-mono text-white">{{ $this->order->order_number }}</div>
            </div>
            
            <div class="flex justify-between items-center border-b border-sentry-border pb-4">
                <div class="sentry-label text-xs">Status</div>
                <div class="text-sentry-light uppercase text-xs font-bold tracking-widest">{{ $this->order->status->value }}</div>
            </div>

            <div class="flex justify-between items-center border-b border-sentry-border pb-4">
                <div class="sentry-label text-xs">Total Charged</div>
                <div class="text-xl font-mono font-bold">€{{ number_format($this->order->total_amount, 2) }}</div>
            </div>

            <div class="pt-4">
                <div class="sentry-label text-[10px] mb-2 opacity-50">Delivery Address</div>
                <div class="text-sm text-sentry-light leading-relaxed">
                    {{ $this->order->shipping_name }}<br>
                    {{ $this->order->shipping_address }}
                </div>
            </div>
        </div>

        <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4">
            <a href="/" wire:navigate class="btn-sentry-white px-12 py-4">Return to Shop</a>
            <a href="#" class="btn-sentry-primary px-12 py-4">View Collection</a>
        </div>

        <p class="mt-12 text-xs text-sentry-light opacity-40">
            A confirmation email has been sent to {{ $this->order->billing_email }}.<br>
            For support, please contact the Riftbound Council.
        </p>
    </div>
</div>
