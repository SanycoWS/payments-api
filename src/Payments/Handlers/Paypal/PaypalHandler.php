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
            'mode' => $authData->isSandbox() === false ? 'live' : 'sandbox',
            // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id' => $authData->getPublic(),
                'client_secret' => $authData->getPrivate(),
                'app_id' => $authData->getId(),
            ],
            'live' => [
                'client_id' => $authData->getPublic(),
                'client_secret' => $authData->getPrivate(),
                'app_id' => $authData->getId(),
            ],
            'payment_action' => 'Sale',
            // Can only be 'Sale', 'Authorization' or 'Order'
            'currency' => 'USD',
            'notify_url' => '',
            // Change this accordingly for your application.
            'locale' => 'en_US',
            // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl' => true,
            // Validate SSL when creating api client.
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
