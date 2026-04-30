<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Enums\UserRole;
use function Pest\Laravel\{actingAs, get};

test('non-admin cannot access admin dashboard', function () {
    $user = User::factory()->create(['role' => UserRole::USER]);
    
    actingAs($user)->get('/dashboard/mission')
        ->assertStatus(403);
});

test('admin can access admin dashboard', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN]);
    
    actingAs($admin)->get('/dashboard/mission')
        ->assertStatus(200);
});

test('admin can see products list', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN]);
    
    actingAs($admin)->get('/products')
        ->assertStatus(200);
});
