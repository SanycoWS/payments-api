<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Stripe;

use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;
use Sanycows\PaymentsApi\Payments\DTO\PaymentInfoDTO;
use Sanycows\PaymentsApi\Payments\PaymentsInterface;
use Stripe\StripeClient;

class StripeHandler implements PaymentsInterface
{

    public function __construct(
        protected StripeClient $stripe
    ) {
    }

    public function getPaymentInfo(string $paymentId): PaymentInfoDTO
    {
        return (new GetPaymentInfoService())->handle($this->stripe, $paymentId);
    }

    public function cratePayment(MakePaymentDTO $paymentDTO): string
    {
        return (new CreatePaymentService())->handle($this->stripe, $paymentDTO);
    }

}
