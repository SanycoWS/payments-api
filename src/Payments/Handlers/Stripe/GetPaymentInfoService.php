<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Stripe;

use Sanycows\PaymentsApi\Enums\Currency;
use Sanycows\PaymentsApi\Enums\Payments;
use Sanycows\PaymentsApi\Enums\Status;
use Sanycows\PaymentsApi\Payments\DTO\PayerDTO;
use Sanycows\PaymentsApi\Payments\DTO\PaymentInfoDTO;
use Stripe\StripeClient;

class GetPaymentInfoService
{
    public function handle(StripeClient $stripeClient, string $paymentId): PaymentInfoDTO
    {
        $response = $stripeClient->paymentIntents->retrieve($paymentId);;
        $resultArray = ($response->toArray());

        return new PaymentInfoDTO(
            $this->getStatus($resultArray['status']),
            Payments::STRIPE,
            $resultArray['client_secret'],
            $resultArray['id'],
            $resultArray['amount_received'] / 100,
            $this->getCurrency($resultArray['currency']),
            $resultArray['created'],
            new PayerDTO(
                '',
                null,
                null,
                null,
            ),
        );
    }

    private function getStatus(string $status): Status
    {
        return match ($status) {
            'succeeded' => Status::SUCCESS,
            default => Status::FAILED,
        };
    }

    private function getCurrency(string $status): Currency
    {
        return match ($status) {
            'usd' => Currency::USD,
            default => Currency::EUR,
        };
    }
}
