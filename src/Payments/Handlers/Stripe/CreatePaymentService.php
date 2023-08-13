<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Stripe;

use Sanycows\PaymentsApi\Enums\Currency;
use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;
use Stripe\StripeClient;

class CreatePaymentService
{

    public function handle(StripeClient $stripeClient, MakePaymentDTO $paymentDTO): string
    {
        $result = $stripeClient->paymentIntents->create([
            'amount' => $paymentDTO->getAmount() * 100,
            'currency' => $this->getCurrency($paymentDTO->getCurrency()),
        ]);

        return $result->client_secret;
    }

    private function getCurrency(Currency $currency): string
    {
        return match ($currency) {
            Currency::USD => 'usd',
            Currency::EUR => 'eur',
        };
    }
}
