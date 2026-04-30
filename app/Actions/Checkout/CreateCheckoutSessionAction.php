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
        return $sessionUrl;
    }
}
