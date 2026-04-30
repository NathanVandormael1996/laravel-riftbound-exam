<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages.shop.index')->name('shop.index');

Route::livewire('/cart', 'pages.cart.index')->name('cart.index');
Route::livewire('/checkout', 'pages.checkout.index')->name('checkout.index');
Route::livewire('/checkout/success/{order:order_number}', 'pages.checkout.success')->name('checkout.success');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::livewire('profile', 'pages.user')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::livewire('/my-orders', 'pages.orders.index')->name('orders.index');
    Route::livewire('/my-orders/{order}', 'pages.orders.show')->name('orders.show');
});

Route::livewire('/qr-login/{token}', 'pages.auth.qr-claim')->name('qr.claim');

require __DIR__.'/auth.php';

// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])
    ->name('admin.')
    ->group(function () {
        Route::livewire('/dashboard/mission', 'pages.admin.dashboard')->name('dashboard');
        Route::livewire('/products', 'pages.admin.products.index')->name('products.index');
        Route::livewire('/products/create', 'pages.admin.products.create')->name('products.create');
        Route::livewire('/products/{product}/edit', 'pages.admin.products.edit')->name('products.edit');
        Route::livewire('/categories', 'pages.admin.categories.index')->name('categories.index');
        Route::livewire('/orders', 'pages.admin.orders.index')->name('orders.index');
        Route::livewire('/orders/{order}', 'pages.admin.orders.show')->name('orders.show');
    });

Route::post('/stripe/webhook', \App\Http\Controllers\StripeWebhookController::class)->name('stripe.webhook');

Route::livewire('/products/{product:slug}', 'pages.shop.show')->name('shop.show');
