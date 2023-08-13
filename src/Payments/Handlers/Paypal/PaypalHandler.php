<?php

namespace Sanycows\PaymentsApi\Payments\Handlers\Paypal;

use Sanycows\PaymentsApi\Payments\DTO\AuthDataDTO;
use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;
use Sanycows\PaymentsApi\Payments\DTO\PaymentInfoDTO;
use Sanycows\PaymentsApi\Payments\PaymentsInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalHandler implements PaymentsInterface
{
    public function __construct(
        protected PayPalClient $payPalClient,
        AuthDataDTO $authData
    ) {
        $this->payPalClient->setApiCredentials([
            'client_id' => $authData->getPublic(),
            'client_secret' => $authData->getPrivate(),
            'app_id' => $authData->getId(),
        ]);
        $this->payPalClient->getAccessToken();
    }

    public function getPaymentInfo(string $paymentId): PaymentInfoDTO
    {
        return (new GetPaymentInfoService())->handle($this->payPalClient, $paymentId);
    }

    public function cratePayment(MakePaymentDTO $paymentDTO): string
    {
        return (new CreatePaymentService())->handle($this->payPalClient, $paymentDTO);
    }
}
