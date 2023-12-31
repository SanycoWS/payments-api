<?php

namespace Sanycows\PaymentsApi\Payments;

use Sanycows\PaymentsApi\Enums\Payments;
use Sanycows\PaymentsApi\Payments\DTO\AuthDataDTO;
use Sanycows\PaymentsApi\Payments\Handlers\Liqpay\LiqpayHandler;
use Sanycows\PaymentsApi\Payments\Handlers\Paypal\PaypalHandler;
use Sanycows\PaymentsApi\Payments\Handlers\Stripe\StripeHandler;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\StripeClient;

class PaymentFactory
{

    public function getInstance(Payments $payments, array $configData): PaymentsInterface
    {
        return match ($payments) {
            Payments::PAYPAL => new PaypalHandler(
                new PayPalClient(),
                new AuthDataDTO(
                    $configData['paypal']['client_id'],
                    $configData['paypal']['client_secret'],
                    $configData['paypal']['app_id'],
                    $configData['paypal']['mode'],
                )
            ),
            Payments::STRIPE => new StripeHandler(new StripeClient($configData['stripe']['secret_key'])),
            Payments::LIQPAY => new LiqpayHandler(
                new AuthDataDTO(
                    $configData['liqpay']['public_key'],
                    $configData['liqpay']['private_key'],
                    null,
                )
            ),
        };
    }
}
