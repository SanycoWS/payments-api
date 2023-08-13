<?php

namespace Sanycows\PaymentsApi\Enums;

enum Payments: int
{
    case PAYPAL = 1;
    case STRIPE = 2;
    case LIQPAY = 3;

}
