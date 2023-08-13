<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Liqpay;

use Sanycows\PaymentsApi\Enums\Currency;
use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;

class CreatePaymentService
{

    public function handle(Liqpay $liqpay, MakePaymentDTO $paymentDTO): string
    {
        return
            json_encode(
                $liqpay->cnb_form_raw([
                    'version' => 3,
                    'amount' => $paymentDTO->getAmount(),
                    'currency' => $this->getCurrency($paymentDTO->getCurrency()),
                    'description' => $paymentDTO->getDescription(),
                    'order_id' => (int)round(microtime(true) * 1000),
                    'action' => 'pay',
                ])
            );
    }

    private function getCurrency(Currency $currency): string
    {
        return match ($currency) {
            Currency::USD => 'USD',
            Currency::EUR => 'EUR',
        };
    }
}
