<?php
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
new #[Layout('layouts.app')] class extends Component
{
    public $name = '';
    public $description = '';
    public $editingId = null;
    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
    ];
    #[Computed]
    public function categories()
    {
        return Category::all();
    }
    public function edit(Category $category)
    {
        $this->editingId = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
    }
    public function save()
    {
        $this->validate();
        if ($this->editingId) {
            Category::find($this->editingId)->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
            $this->dispatch('notify', ['type' => 'success', 'message' => 'Faction updated!']);
        } else {
            Category::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
                'is_active' => true,
            ]);
            $this->dispatch('notify', ['type' => 'success', 'message' => 'Faction deployed!']);
        }
        $this->reset(['name', 'description', 'editingId']);
    }
    public function delete(Category $category)
    {
        if ($category->products()->exists()) {
            $this->dispatch('notify', ['type' => 'error', 'message' => 'Cannot delete faction with active cards!']);
            return;
        }
        $category->delete();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Faction removed.']);
    }
}; ?>
<div class="min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <div class="flex items-center gap-2 mb-4">
                <a href="{{ route('admin.dashboard') }}" class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-30 hover:opacity-70 transition-opacity">Command Center</a>
                <span class="text-sentry-border">/</span>
                <span class="font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-80">Factions</span>
            </div>
            <h1 class="font-display text-5xl font-bold text-white">Faction Management</h1>
            <p class="mt-2 text-sentry-light opacity-50 text-sm">Control the League of Legends faction categories.</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <aside>
                <div class="bg-sentry-darker border border-sentry-border rounded-xl overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.4)] sticky top-24">
                    <div class="px-6 py-4 border-b border-sentry-border/50 bg-sentry-deep/40 flex items-center gap-3">
                        <div class="w-1.5 h-1.5 rounded-full {{ $editingId ? 'bg-sentry-coral' : 'bg-sentry-light' }} transition-colors"></div>
                        <h2 class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-60">
                            {{ $editingId ? 'Editing Faction' : 'New Faction' }}
                        </h2>
                    </div>
                    <form wire:submit="save" class="p-6 space-y-4">
                        <div class="space-y-2">
                            <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">Faction Name</label>
                            <input wire:model="name" type="text"
                                   class="w-full bg-sentry-deep border border-sentry-border rounded-xl px-4 py-3 text-white placeholder-sentry-light/20 font-sans text-sm focus:outline-none focus:border-sentry-purple/60 focus:ring-1 focus:ring-sentry-purple/30 transition-colors @error('name') border-sentry-pink/60 @enderror"
                                   placeholder="e.g. Noxus">
                            @error('name') <p class="font-mono text-[10px] text-sentry-pink mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block font-mono text-[10px] uppercase tracking-[2px] text-sentry-light opacity-50">Description</label>
                            <textarea wire:model="description" rows="4"
                                      class="w-full bg-sentry-deep border border-sentry-border rounded-xl px-4 py-3 text-white placeholder-sentry-light/20 font-sans text-sm resize-none focus:outline-none focus:border-sentry-purple/60 focus:ring-1 focus:ring-sentry-purple/30 transition-colors @error('description') border-sentry-pink/60 @enderror"
                                      placeholder="A brutal empire of strength and conquest..."></textarea>
                            @error('description') <p class="font-mono text-[10px] text-sentry-pink mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="submit"
                                    class="flex-1 {{ $editingId ? 'bg-sentry-coral text-sentry-deep' : 'bg-sentry-light text-sentry-deep' }} font-mono text-[12px] font-bold uppercase tracking-[1.5px] py-3 rounded-[13px] shadow-[inset_0_1px_3px_rgba(0,0,0,0.1)] hover:scale-[1.02] transition-all duration-200">
                                {{ $editingId ? 'Update' : 'Deploy' }}
                            </button>
                            @if($editingId)
                                <button type="button" wire:click="$set('editingId', null)"
                                        class="px-4 py-3 rounded-[13px] border border-sentry-border text-sentry-light opacity-50 hover:opacity-100 hover:border-sentry-border transition-all font-mono text-[11px]">
                                    ✕
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </aside>
            <div class="lg:col-span-2 space-y-4">
                @forelse($this->categories as $category)
                    <div class="group relative bg-sentry-darker border border-sentry-border rounded-xl p-6 shadow-[0_10px_30px_rgba(0,0,0,0.3)] hover:border-sentry-border/80 transition-all duration-200 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-sentry-purple/3 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-start justify-between gap-4">
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-2 h-2 rounded-full bg-sentry-border group-hover:bg-sentry-light transition-colors duration-300"></div>
                                    <h3 class="font-bold text-lg text-white">{{ $category->name }}</h3>
                                    <span class="font-mono text-[9px] uppercase tracking-[2px] text-sentry-light opacity-30">{{ $category->products->count() ?? 0 }} cards</span>
                                </div>
                                <p class="font-mono text-[11px] text-sentry-light opacity-40 leading-relaxed line-clamp-2 ml-5">
                                    {{ \Illuminate\Support\Str::limit($category->description, 120) }}
                                </p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button wire:click="edit({{ $category->id }})"
                                        class="p-2.5 rounded-xl border border-sentry-border text-sentry-light opacity-30 hover:opacity-100 hover:border-sentry-purple/50 hover:text-sentry-light hover:bg-sentry-purple/10 transition-all duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <button wire:click="delete({{ $category->id }})"
                                        class="p-2.5 rounded-xl border border-sentry-border text-sentry-light opacity-20 hover:opacity-100 hover:border-sentry-pink/40 hover:text-sentry-pink hover:bg-sentry-pink/10 transition-all duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-sentry-darker border border-sentry-border rounded-xl p-20 text-center">
                        <p class="font-mono text-[11px] uppercase tracking-[3px] text-sentry-light opacity-30">No factions deployed yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
