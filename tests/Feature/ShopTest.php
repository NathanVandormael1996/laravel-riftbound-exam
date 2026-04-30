<?php

use App\Models\Product;
use App\Models\Category;
use function Pest\Laravel\get;

test('shop homepage lists products', function () {
    $category = Category::factory()->create(['name' => 'Spells']);
    Product::factory()->count(3)->create([
        'category_id' => $category->id,
        'is_active' => true,
    ]);

    get('/')->assertStatus(200)->assertSee('Spells');
});

test('product detail page works', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'category_id' => $category->id,
        'slug' => 'legendary-dragon',
        'is_active' => true,
    ]);

    get('/products/legendary-dragon')->assertStatus(200)->assertSee($product->name);
});
