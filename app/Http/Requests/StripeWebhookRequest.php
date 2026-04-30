<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StripeWebhookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Stripe webhooks don't follow standard form rules, 
            // but we can ensure the signature header is present.
        ];
    }
    
    public function validateSignature(): string
    {
        return $this->header('Stripe-Signature') ?? '';
    }
}
