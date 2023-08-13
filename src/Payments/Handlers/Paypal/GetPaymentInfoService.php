<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Paypal;

use App\Enums\Currency;
use App\Enums\Payments;
use Sanycows\PaymentsApi\Enums\Status;
use Sanycows\PaymentsApi\Payments\DTO\PayerDTO;
use Sanycows\PaymentsApi\Payments\DTO\PaymentInfoDTO;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class GetPaymentInfoService
{
    public function handle(PayPalClient $payPal, string $paymentId): PaymentInfoDTO
    {
        $response = $payPal->capturePaymentOrder($paymentId);
        return new PaymentInfoDTO(
            $this->getStatus($response['status']),
            Payments::PAYPAL,
            $response['purchase_units']['0']['payments']['captures']['0']['id'],
            $response['id'],
            $response['purchase_units']['0']['payments']['captures']['0']['amount']['value'],
            $this->getCurrency($response['purchase_units']['0']['payments']['captures']['0']['amount']['currency_code']),
            time(),
            new PayerDTO('test'),
        );
    }

    private function getStatus(string $status): Status
    {
        return match ($status) {
            'COMPLETED' => Status::SUCCESS,
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
