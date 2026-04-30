<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCart(): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }

        $sessionId = Session::getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    public function addItem(Product $product, int $quantity = 1): void
    {
        $cart = $this->getCart();
        
        $item = $cart->items()->where('product_id', $product->id)->first();
        $currentQty = $item ? $item->quantity : 0;

        if ($currentQty + $quantity > $product->stock) {
            throw new \Exception("Cannot add more than {$product->stock} of {$product->name} to cart.");
        }

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }
    }

    public function removeItem(int $productId): void
    {
        $cart = $this->getCart();
        $cart->items()->where('product_id', $productId)->delete();
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->getCart();
        $item = $cart->items()->where('product_id', $productId)->first();

        if ($item) {
            $product = $item->product;
            if ($quantity <= 0) {
                $item->delete();
            } elseif ($quantity > $product->stock) {
                $item->update(['quantity' => $product->stock]);
                throw new \Exception("Only {$product->stock} of {$product->name} available.");
            } else {
                $item->update(['quantity' => $quantity]);
            }
        }
    }

    public function clear(): void
    {
        $this->getCart()->items()->delete();
    }

    public function mergeSessionCartWithUser(): void
    {
        if (!Auth::check()) return;

        $sessionCart = Cart::where('session_id', Session::getId())->first();
        if (!$sessionCart) return;

        $userCart = $this->getCart();

        foreach ($sessionCart->items as $item) {
            $existing = $userCart->items()->where('product_id', $item->product_id)->first();
            if ($existing) {
                $existing->increment('quantity', $item->quantity);
            } else {
                $item->update(['cart_id' => $userCart->id]);
            }
        }

        $sessionCart->delete();
    }
}
