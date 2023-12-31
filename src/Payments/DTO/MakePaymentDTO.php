<?php

namespace Sanycows\PaymentsApi\Payments\DTO;

use Sanycows\PaymentsApi\Enums\Currency;

class MakePaymentDTO
{
    public function __construct(
        protected float $amount,
        protected Currency $currency,
        protected string $description = '',
    ) {
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

}
