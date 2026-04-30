<?php

namespace App\Actions\Checkout;

use App\Models\Order;
use App\Services\StripeService;

class CreateCheckoutSessionAction
{
    public function __construct(
        protected StripeService $stripeService
    ) {}

    public function handle(Order $order): string
    {
        $sessionUrl = $this->stripeService->createCheckoutSession($order);

        // We could store the session ID on the order here if we had a real one
        // $order->update(['stripe_session_id' => $session->id]);

        return $sessionUrl;
    }
}
