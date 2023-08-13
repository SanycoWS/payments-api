<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Liqpay;

use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;
use Sanycows\PaymentsApi\Payments\PaymentsInterface;

class LiqpayHandler implements PaymentsInterface
{

    public function getPaymentInfo(string $paymentId): bool
    {
        // TODO: Implement makePayment() method.
    }

    public function cratePayment(MakePaymentDTO $paymentDTO): string
    {
        // TODO: Implement cratePayment() method.
    }
}
