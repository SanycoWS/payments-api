<?php

namespace Sanycows\PaymentsApi\Payments;

use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;
use Sanycows\PaymentsApi\Payments\DTO\PaymentInfoDTO;

interface PaymentsInterface
{

    public function getPaymentInfo(string $paymentId): PaymentInfoDTO;

    public function cratePayment(MakePaymentDTO $paymentDTO): string;
}
