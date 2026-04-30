<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Product;
use App\Enums\ProductBadge;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product = null;

    public $name = '';
    public $slug = '';
    public $description = '';
    public $price = '';
    public $stock = '';
    public $category_id = '';
    public $badge = 'none';
    public $is_active = true;
    public $is_featured = false;
    public $newImage;

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->badge = $product->badge->value;
        $this->is_active = $product->is_active;
        $this->is_featured = $product->is_featured;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($this->product?->id)],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'badge' => ['required', Rule::enum(ProductBadge::class)],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'newImage' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function store()
    {
        $this->validate();
        
        $data = $this->except('product', 'newImage');
        if ($this->newImage) {
            $data['image'] = $this->newImage->store('products', 'public');
        }
        
        Product::create($data);
    }

    public function update()
    {
        $this->validate();
        
        $data = $this->except('product', 'newImage');
        if ($this->newImage) {
            $data['image'] = $this->newImage->store('products', 'public');
        }
        
        $this->product->update($data);
    }
}
