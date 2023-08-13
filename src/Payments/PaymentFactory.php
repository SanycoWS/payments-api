<?php

namespace Sanycows\PaymentsApi\Payments;

use App\Enums\Payments;
use Sanycows\PaymentsApi\Payments\DTO\AuthDataDTO;
use Sanycows\PaymentsApi\Payments\Handlers\Liqpay\LiqpayHandler;
use Sanycows\PaymentsApi\Payments\Handlers\Paypal\PaypalHandler;
use Sanycows\PaymentsApi\Payments\Handlers\Stripe\StripeHandler;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\StripeClient;

class PaymentFactory
{

    public function getInstance(Payments $payments, AuthDataDTO $authData): PaymentsInterface
    {
        return match ($payments) {
            Payments::PAYPAL => new PaypalHandler(new PayPalClient(), $authData),
            Payments::STRIPE => new StripeHandler(new StripeClient($authData->getPrivate())),
            Payments::LIQPAY => new LiqpayHandler(),
        };
    }
}
