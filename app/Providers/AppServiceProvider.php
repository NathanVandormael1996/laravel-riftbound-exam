<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }
    public function boot(): void
    {
        \Illuminate\Support\Facades\Route::macro('livewire', function ($uri, $componentName) {
            return \Livewire\Volt\Volt::route($uri, $componentName);
        });
    }
}
