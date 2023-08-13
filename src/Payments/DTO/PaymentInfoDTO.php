<?php

namespace Sanycows\PaymentsApi\Payments\DTO;

use App\Enums\Currency;
use App\Enums\Payments;
use Sanycows\PaymentsApi\Enums\Status;

class PaymentInfoDTO
{
    public function __construct(
        protected Status $status,
        protected Payments $paymentSystem,
        protected string $orderId,
        protected string $paymentId,
        protected string $amount,
        protected Currency $currency,
        protected int $time,
        protected ?PayerDTO $payer,
    ) {
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return Payments
     */
    public function getPaymentSystem(): Payments
    {
        return $this->paymentSystem;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    /**
     * @return string
     */
    public function getAmount(): string
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
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @return PayerDTO|null
     */
    public function getPayer(): ?PayerDTO
    {
        return $this->payer;
    }


}
