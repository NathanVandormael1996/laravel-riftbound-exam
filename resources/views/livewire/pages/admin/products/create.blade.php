<?php


use App\Livewire\Forms\Admin\ProductForm;
use App\Models\Category;
use App\Enums\ProductBadge;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts.app')] class extends Component
{
    use WithFileUploads;

    public ProductForm $form;

    #[Computed]
    public function categories()
    {
        return Category::all();
    }

    #[Computed]
    public function badges()
    {
        return ProductBadge::cases();
    }

    public function save()
    {
        $this->form->store();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'New card deployed successfully!']);
        return redirect()->route('admin.products.index');
    }
}; ?>

@include('livewire.pages.admin.products._form')
