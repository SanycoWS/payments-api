<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Liqpay;

use Sanycows\PaymentsApi\Payments\DTO\AuthDataDTO;
use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;
use Sanycows\PaymentsApi\Payments\DTO\PaymentInfoDTO;
use Sanycows\PaymentsApi\Payments\PaymentsInterface;

class LiqpayHandler implements PaymentsInterface
{
    protected Liqpay $liqpay;

    public function __construct(AuthDataDTO $authDataDTO)
    {
        $this->liqpay = new Liqpay($authDataDTO->getPublic(), $authDataDTO->getPrivate());
    }

    public function getPaymentInfo(string $paymentId): PaymentInfoDTO
    {
        return (new GetPaymentInfoService())->handle($this->liqpay, $paymentId);
    }

    public function cratePayment(MakePaymentDTO $paymentDTO): string
    {
        return (new CreatePaymentService())->handle($this->liqpay, $paymentDTO);
    }
}
