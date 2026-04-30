 <?php
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
new #[Layout('layouts.app')] class extends Component
{
    public Product $product;
    public function mount(Product $product)
    {
        $this->product = $this->product->load('category');
    }
    public function addToCart()
    {
        try {
            app(\App\Services\CartService::class)->addItem($this->product);
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => "Added {$this->product->name} to collection!"
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 space-x-2 sentry-label text-[10px]" aria-label="Breadcrumb">
            <a href="/" wire:navigate class="hover:text-white">Shop</a>
            <span class="opacity-30">/</span>
            <span class="opacity-30">{{ $this->product->category->name }}</span>
            <span class="opacity-30">/</span>
            <span class="text-white">{{ $this->product->name }}</span>
        </nav>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Product Image / Card View -->
            <div class="sentry-card bg-sentry-deep border-sentry-border aspect-[4/5] flex items-center justify-center relative overflow-hidden group">
                @if($this->product->image)
                    <img src="{{ $this->product->image }}" alt="{{ $this->product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="text-sentry-border w-1/2 h-1/2">
                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                @if($this->product->badge->value !== 'none')
                    <div class="absolute top-8 right-8 bg-sentry-deep/90 backdrop-blur px-6 py-2 rounded-full border border-sentry-border shadow-xl">
                        <span class="text-xs uppercase font-bold tracking-[2px] {{ 
                            $this->product->badge->value === 'legendary' ? 'text-sentry-light' : (
                            $this->product->badge->value === 'epic' ? 'text-sentry-pink' : 'text-sentry-light'
                            )
                        }}">
                            {{ $this->product->badge->value }}
                        </span>
                    </div>
                @endif
                <!-- Ambient Glow -->
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-sentry-purple/20 rounded-full blur-[100px]"></div>
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-sentry-light/10 rounded-full blur-[100px]"></div>
            </div>
            <!-- Product Details -->
            <div class="space-y-8">
                <div class="space-y-2">
                    <div class="sentry-label text-sentry-light">{{ $this->product->category->name }}</div>
                    <h1 class="font-display text-6xl font-bold leading-tight">{{ $this->product->name }}</h1>
                </div>
                <div class="flex items-center space-x-6 py-6 border-y border-sentry-border">
                    <div class="text-4xl font-mono font-bold text-sentry-light">
                        €{{ number_format($this->product->price, 2) }}
                    </div>
                    <div class="h-8 w-[1px] bg-sentry-border"></div>
                    <div class="space-y-1">
                        <div class="sentry-label text-[10px]">Stock Status</div>
                        <div class="text-sm {{ $this->product->stock > 0 ? 'text-white' : 'text-sentry-pink' }}">
                            {{ $this->product->stock > 0 ? $this->product->stock . ' cards available' : 'Out of stock' }}
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="sentry-label">Card Lore & Description</h3>
                    <div class="text-sentry-light leading-relaxed text-lg opacity-80 prose prose-invert">
                        {!! nl2br(e($this->product->description)) !!}
                    </div>
                </div>
                <!-- Stats View (Riftbound Style) -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-sentry-darker p-4 rounded-lg border border-sentry-border text-center">
                        <div class="sentry-label text-[10px] mb-1">Power</div>
                        <div class="text-2xl font-mono text-sentry-pink">{{ $this->product->power ?? '-' }}</div>
                    </div>
                    <div class="bg-sentry-darker p-4 rounded-lg border border-sentry-border text-center">
                        <div class="sentry-label text-[10px] mb-1">Might</div>
                        <div class="text-2xl font-mono text-sentry-light">{{ $this->product->might ?? '-' }}</div>
                    </div>
                    <div class="bg-sentry-darker p-4 rounded-lg border border-sentry-border text-center">
                        <div class="sentry-label text-[10px] mb-1">Energy</div>
                        <div class="text-2xl font-mono text-sentry-light">{{ $this->product->energy ?? '-' }}</div>
                    </div>
                </div>
                <div class="pt-8">
                    <button 
                        wire:click="addToCart" 
                        class="w-full btn-sentry-primary py-5 text-lg"
                        {{ $this->product->stock <= 0 ? 'disabled' : '' }}
                    >
                        {{ $this->product->stock > 0 ? 'Add to Collection' : 'Sold Out' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
