<?php
use App\Livewire\Forms\Admin\ProductForm;
use App\Models\Category;
use App\Models\Product;
use App\Enums\ProductBadge;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
new #[Layout('layouts.app')] class extends Component
{
    use WithFileUploads;
    public ProductForm $form;
    public function mount(Product $product)
    {
        $this->form->setProduct($product);
    }
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
        $this->form->update();
        $this->dispatch('notify', ['type' => 'success', 'message' => 'Card updated successfully!']);
        return redirect()->route('admin.products.index');
    }
}; ?>
@include('livewire.pages.admin.products._form')
