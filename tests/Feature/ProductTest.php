<?php

use App\Models\Product;
use App\Models\Category;

test('product scopeAvailable only returns in-stock products', function () {
    $category = Category::factory()->create();
    
    Product::factory()->create(['stock' => 0, 'category_id' => $category->id]);
    Product::factory()->create(['stock' => 5, 'category_id' => $category->id]);
    
    expect(Product::available()->count())->toBe(1);
});
