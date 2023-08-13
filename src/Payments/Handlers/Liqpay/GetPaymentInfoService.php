<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Liqpay;

use Sanycows\PaymentsApi\Enums\Currency;
use Sanycows\PaymentsApi\Enums\Payments;
use Sanycows\PaymentsApi\Enums\Status;
use Sanycows\PaymentsApi\Payments\DTO\PayerDTO;
use Sanycows\PaymentsApi\Payments\DTO\PaymentInfoDTO;

class GetPaymentInfoService
{
    public function handle(Liqpay $liqpay, string $paymentId): PaymentInfoDTO
    {
        $response = $liqpay->api("request", [
            'action' => 'status',
            'version' => '3',
            'order_id' => $paymentId,
        ]);
        return new PaymentInfoDTO(
            $this->getStatus($response['status']),
            Payments::PAYPAL,
            $response['order_id'],
            $response['transaction_id'],
            $response['amount'],
            $this->getCurrency($response['currency']),
            $response['create_date'],
            new PayerDTO(
                $response['sender_card_mask2'],
                null,
                null,
                $response['ip']
            ),
        );
    }

    private function getStatus(string $status): Status
    {
        return match ($status) {
            'success' => Status::SUCCESS,
            default => Status::FAILED,
        };
    }

    private function getCurrency(string $status): Currency
    {
        return match ($status) {
            'USD' => Currency::USD,
            default => Currency::EUR,
        };
    }
}
