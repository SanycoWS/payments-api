<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Paypal;

use Sanycows\PaymentsApi\Enums\Currency;
use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CreatePaymentService
{

    public function handle(PayPalClient $payPal, MakePaymentDTO $paymentDTO): string
    {
        $response = $payPal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $this->getCurrency($paymentDTO->getCurrency()),
                        "value" => number_format($paymentDTO->getAmount(), 2, '.')
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            return $response['id'];
        }

        return '';
    }

    private function getCurrency(Currency $currency): string
    {
        return match ($currency) {
            Currency::USD => 'USD',
            Currency::EUR => 'EUR',
        };
    }
}
