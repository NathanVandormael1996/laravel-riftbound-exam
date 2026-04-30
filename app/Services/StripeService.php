<?php
namespace App\Services;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session;
class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }
    public function createCheckoutSession(Order $order): string
    {
        $lineItems = $order->items->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item->product_name_snapshot,
                    ],
                    'unit_amount' => (int) ($item->price_snapshot * 100),
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', ['order' => $order->order_number]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.index'),
            'metadata' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'customer_name' => $order->billing_name,
                'customer_email' => $order->billing_email,
            ],
        ]);
        return $session->url;
    }
    public function verifyPayment(string $sessionId): bool
    {
        $session = Session::retrieve($sessionId);
        return $session->payment_status === 'paid';
    }
    public function refundOrder(Order $order): bool
    {
        if (!$order->stripe_payment_intent_id) {
            return false;
        }
        try {
            \Stripe\Refund::create([
                'payment_intent' => $order->stripe_payment_intent_id,
            ]);
            return true;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Stripe Refund Error: ' . $e->getMessage());
            return false;
        }
    }
}
