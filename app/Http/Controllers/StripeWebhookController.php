<?php

namespace App\Http\Controllers;

use App\Http\Requests\StripeWebhookRequest;
use App\Models\Order;
use App\Enums\OrderStatus;
use Illuminate\Http\Response;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookController extends Controller
{
    public function __invoke(StripeWebhookRequest $request): Response
    {
        $payload = $request->getContent();
        $sigHeader = $request->validateSignature();
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload, $sigHeader, $endpointSecret
            );
        } catch (SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $orderId = $session->metadata->order_id;
            
            $order = Order::find($orderId);
            if ($order && $order->status === OrderStatus::PENDING) {
                $order->update([
                    'status' => OrderStatus::PAID,
                    'stripe_payment_intent_id' => $session->payment_intent,
                ]);
                
                event(new \App\Events\OrderPaid($order));
            }
        }

        return response('Webhook Handled', 200);
    }
}
