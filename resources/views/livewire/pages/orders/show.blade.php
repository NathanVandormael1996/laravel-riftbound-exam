<?php
use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
new #[Layout('layouts.app')] class extends Component
{
    public Order $order;
    public function mount(Order $order)
    {
        $this->order = $order->load('items.product');
        if ($this->order->user_id !== auth()->id()) {
            abort(403);
        }
    }
}; ?>
<div class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('orders.index') }}" wire:navigate class="text-xs sentry-label opacity-40 hover:opacity-100 transition-all flex items-center gap-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to History
            </a>
            <div class="flex items-center gap-3">
                <span class="sentry-label opacity-40">Status:</span>
                <span class="sentry-badge border-sentry-purple text-sentry-purple">{{ $order->status->value }}</span>
            </div>
        </div>
        <div class="space-y-8">
            <div class="sentry-card p-8 md:p-12 relative overflow-hidden">
                <!-- Watermark -->
                <div class="absolute top-0 right-0 p-8 opacity-[0.03] select-none pointer-events-none">
                    <div class="text-8xl font-display font-bold">RIFTBOUND</div>
                </div>
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="space-y-6">
                        <div>
                            <h1 class="sentry-label mb-2">Order Identification</h1>
                            <p class="font-mono text-3xl font-bold text-white">{{ $order->order_number }}</p>
                            <p class="text-xs text-sentry-light opacity-50 mt-1">Processed on {{ $order->created_at->format('F d, Y \a\t H:i') }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <h3 class="sentry-label mb-2">Value</h3>
                                <p class="text-xl font-mono font-bold text-sentry-light">€{{ number_format($order->total_amount, 2) }}</p>
                            </div>
                            <div>
                                <h3 class="sentry-label mb-2">Method</h3>
                                <p class="text-sm font-medium text-white">Stripe Secure</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h3 class="sentry-label mb-2">Deployment Target</h3>
                            <div class="text-sm text-sentry-light leading-relaxed">
                                <p class="font-bold text-white">{{ $order->shipping_name }}</p>
                                <p class="opacity-70">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="sentry-label mb-2">Communication</h3>
                            <p class="text-sm text-white">{{ $order->billing_email }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sentry-glass overflow-hidden">
                <div class="p-6 border-b border-sentry-border bg-sentry-deep/40">
                    <h2 class="sentry-label">Manifest of Contents</h2>
                </div>
                <div class="divide-y divide-sentry-border">
                    @foreach($order->items as $item)
                        <div class="p-6 flex items-center justify-between gap-6 hover:bg-sentry-purple/5 transition-colors">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-20 bg-sentry-darker rounded border border-sentry-border/50 overflow-hidden shrink-0">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ $item->product->image }}" alt="" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-white">{{ $item->product_name_snapshot }}</h4>
                                    <p class="text-[10px] sentry-label opacity-40 mt-1">Acquired Unit Price: €{{ number_format($item->price_snapshot, 2) }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-sentry-light opacity-50 mb-1">x {{ $item->quantity }}</div>
                                <div class="font-mono font-bold text-white">€{{ number_format($item->subtotal, 2) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="p-8 bg-sentry-darker/50 flex justify-between items-end">
                    <div class="text-xs text-sentry-light opacity-40 italic">
                        All physical card deployments are tracked via Noxian courier services.
                    </div>
                    <div class="text-right space-y-1">
                        <div class="sentry-label opacity-40">Total Acquisition Value</div>
                        <div class="text-4xl font-mono font-bold text-sentry-light">€{{ number_format($order->total_amount, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
