<?php

namespace App\Actions\Orders;

use App\Models\Cart;
use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CreateOrderAction
{
    public function handle(Cart $cart, array $data): Order
    {
        return DB::transaction(function () use ($cart, $data) {
            $order = Order::create([
                'user_id' => $cart->user_id,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'total_amount' => $cart->total,
                'status' => OrderStatus::PENDING->value,
                'billing_name' => $data['billing_name'],
                'billing_email' => $data['billing_email'],
                'billing_address' => $data['billing_address'],
                'shipping_name' => $data['shipping_name'] ?? $data['billing_name'],
                'shipping_address' => $data['shipping_address'] ?? $data['billing_address'],
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name_snapshot' => $item->product->name,
                    'price_snapshot' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->subtotal,
                ]);
            }

            return $order;
        });
    }
}
