<?php

namespace Sanycows\PaymentsApi\Payments\DTO;

class AuthDataDTO
{
    /**
     * @param string $public publishableKey|client_id|public_key
     * @param string $private secret_key|client_secret|private_key
     * @param string|null $id app_id
     */
    public function __construct(
        protected string $public,
        protected string $private,
        protected ?string $id,
    ) {
    }

    /**
     * @return string
     */
    public function getPublic(): string
    {
        return $this->public;
    }

    /**
     * @return string
     */
    public function getPrivate(): string
    {
        return $this->private;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }


}
