<?php


use App\Models\Order;
use App\Enums\OrderStatus;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.app')] class extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $status = '';

    #[Computed]
    public function orders()
    {
        return Order::query()
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->latest()
            ->paginate(15);
    }
}; ?>

<div class="min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">
            <div class="flex items-center gap-2 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-30 hover:opacity-70 transition-opacity">Command Center</a>
                <span class="text-sentry-border">/</span>
                <span class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-80">Acquisition Log</span>
            </div>
            <h1 class="font-display text-5xl font-bold text-white">Acquisition Log</h1>
            <p class="mt-2 text-sentry-light opacity-50 text-sm">All incoming orders across the Riftbound marketplace.</p>
        </div>

        {{-- Status Filter Tabs --}}
        <div class="flex flex-wrap items-center gap-2 mb-6">
            <button wire:click="$set('status', '')"
                    class="font-mono text-[10px] uppercase tracking-[2px] px-4 py-2 rounded-full border transition-all duration-150 {{ $this->status === '' ? 'border-sentry-light/50 bg-sentry-light/10 text-sentry-light' : 'border-sentry-border text-sentry-light opacity-40 hover:opacity-80 hover:border-sentry-border' }}">
                All
            </button>
            @foreach(\App\Enums\OrderStatus::cases() as $s)
                @php
                    $isActive = $this->status === $s->value;
                    $activeColors = ['paid' => 'border-sentry-light/50 bg-sentry-light/10 text-sentry-light', 'pending' => 'border-sentry-coral/50 bg-sentry-coral/10 text-sentry-coral', 'shipped' => 'border-sentry-purple/50 bg-sentry-purple/10 text-sentry-light', 'completed' => 'border-sentry-light/30 bg-sentry-light/5 text-sentry-light'];
                    $activeClass = $activeColors[$s->value] ?? 'border-sentry-border text-sentry-light';
                @endphp
                <button wire:click="$set('status', '{{ $s->value }}')"
                        class="font-mono text-[10px] uppercase tracking-[2px] px-4 py-2 rounded-full border transition-all duration-150 {{ $isActive ? $activeClass : 'border-sentry-border text-sentry-light opacity-40 hover:opacity-80 hover:border-sentry-border' }}">
                    {{ $s->value }}
                </button>
            @endforeach
        </div>

        {{-- Orders Table --}}
        <div class="bg-sentry-darker border border-sentry-border rounded-xl overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.4)]">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-sentry-border bg-sentry-deep/60">
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Reference</th>
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Client</th>
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Date</th>
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Total</th>
                        <th class="px-6 py-4 text-left font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-40">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sentry-border/40">
                    @forelse($this->orders as $order)
                        <tr class="group hover:bg-sentry-purple/5 transition-colors duration-150">
                            <td class="px-6 py-4 font-mono text-xs text-sentry-light opacity-60 tracking-wider">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 text-sm text-white/80">{{ $order->billing_name }}</td>
                            <td class="px-6 py-4 font-mono text-[11px] text-sentry-light opacity-40">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 font-mono text-sm font-bold text-sentry-light">€{{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $pills = ['paid' => 'border-sentry-light/30 bg-sentry-light/10 text-sentry-light', 'pending' => 'border-sentry-coral/30 bg-sentry-coral/10 text-sentry-coral', 'shipped' => 'border-sentry-purple/30 bg-sentry-purple/10 text-sentry-light', 'completed' => 'border-sentry-light/20 bg-sentry-light/5 text-sentry-light', 'cancelled' => 'border-red-500/50 bg-red-500/20 text-red-500'];
                                    $pillClass = $pills[$order->status->value] ?? 'border-sentry-border text-sentry-light';
                                @endphp
                                <span class="font-mono text-[9px] uppercase tracking-[2px] px-2.5 py-1 rounded-full border {{ $pillClass }}">
                                    {{ $order->status->value }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="text-sentry-border group-hover:text-sentry-light transition-colors">
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <p class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-30">No orders found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($this->orders->hasPages())
                <div class="px-6 py-4 border-t border-sentry-border/50 bg-sentry-deep/30">
                    {{ $this->orders->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
