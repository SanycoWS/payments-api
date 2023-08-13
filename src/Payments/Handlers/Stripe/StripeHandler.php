<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Stripe;

use App\Enums\Currency;
use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;
use Sanycows\PaymentsApi\Payments\PaymentsInterface;
use Stripe\StripeClient;

class StripeHandler implements PaymentsInterface
{

    public function __construct(
        protected StripeClient $stripe
    ) {
    }

    public function getPaymentInfo(string $paymentId): bool
    {
        $result = $this->stripe->paymentIntents->retrieve($paymentId);

        return $result->status === 'succeeded';
    }

    public function cratePayment(MakePaymentDTO $paymentDTO): string
    {
        $result = $this->stripe->paymentIntents->create([
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
