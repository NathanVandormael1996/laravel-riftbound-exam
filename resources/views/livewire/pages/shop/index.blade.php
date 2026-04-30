 <?php
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;
new #[Layout('layouts.app')] class extends Component
{
    use WithPagination;
    public $search = '';
    public $categorySlug = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingCategorySlug()
    {
        $this->resetPage();
    }
    #[Computed]
    public function categories()
    {
        return Category::where('is_active', true)->get();
    }
    #[Computed]
    public function products()
    {
        return Product::query()
            ->with('category')
            ->where('is_active', true)
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->categorySlug, fn($q) => $q->whereHas('category', fn($cq) => $cq->where('slug', $this->categorySlug)))
            ->latest()
            ->paginate(12);
    }
    public function clearFilters()
    {
        $this->reset(['search', 'categorySlug']);
    }
}; ?>
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
                            class="text-left px-3 py-2 rounded-md transition-colors {{ !$this->categorySlug ? 'bg-sentry-purple text-white' : 'text-sentry-light hover:bg-sentry-darker' }}"
                        >
                            All Factions
                        </button>
                        @foreach($this->categories as $category)
                            <button 
                                wire:click="$set('categorySlug', '{{ $category->slug }}')"
                                class="text-left px-3 py-2 rounded-md transition-colors {{ $this->categorySlug === $category->slug ? 'bg-sentry-purple text-white' : 'text-sentry-light hover:bg-sentry-darker' }}"
                            >
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
                @if($this->search || $this->categorySlug)
                    <button 
                        wire:click="clearFilters" 
                        class="text-sentry-light text-xs uppercase font-bold tracking-widest hover:underline"
                    >
                        Clear Filters
                    </button>
                @endif
            </aside>
            <!-- Main Content -->
            <div class="flex-grow">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h1 class="font-display text-4xl font-bold">Marketplace</h1>
                        <p class="text-sentry-light opacity-60">Discover the rarest cards from all factions.</p>
                    </div>
                    <div class="sentry-label text-xs">
                        Showing {{ $this->products->firstItem() ?? 0 }} - {{ $this->products->lastItem() ?? 0 }} of {{ $this->products->total() }} results
                    </div>
                </div>
                <!-- Product Grid -->
                @if($this->products->isEmpty())
                    <div class="sentry-glass p-12 text-center">
                        <div class="text-sentry-light text-4xl mb-4 font-display">No cards found</div>
                        <p class="text-sentry-light">Try adjusting your filters or search terms.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($this->products as $product)
                            <a href="{{ route('shop.show', $product->slug) }}" wire:navigate class="sentry-card group hover:border-sentry-purple transition-all duration-300 hover:-translate-y-1">
                                <div class="aspect-[4/5] bg-sentry-deep relative overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-sentry-border group-hover:text-sentry-purple transition-colors">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                    <!-- Badge -->
                                    @if($product->badge->value !== 'none')
                                        <div class="absolute top-4 right-4 bg-sentry-deep/80 backdrop-blur px-3 py-1 rounded-full border border-sentry-border">
                                            <span class="text-[10px] uppercase font-bold tracking-widest {{ 
                                                $product->badge->value === 'legendary' ? 'text-sentry-light' : (
                                                $product->badge->value === 'epic' ? 'text-sentry-pink' : 'text-sentry-light'
                                                )
                                            }}">
                                                {{ $product->badge->value }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-5 space-y-4">
                                    <div class="space-y-1">
                                        <div class="sentry-label text-[10px] opacity-50">{{ $product->category->name }}</div>
                                        <h3 class="text-xl font-bold group-hover:text-sentry-light transition-colors">{{ $product->name }}</h3>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="text-2xl font-mono font-bold text-sentry-light">
                                            €{{ number_format($product->price, 2) }}
                                        </div>
                                        <div class="btn-sentry-primary px-4 py-2 text-xs">
                                            View Details
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $this->products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
