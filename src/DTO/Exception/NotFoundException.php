<?php

declare(strict_types=1);

namespace App\DTO\Exception;

final class NotFoundException
{
    private int $code;

    private string $message;

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     *
     * @return NotFoundException
     */
    public function setCode(int $code): NotFoundException
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return NotFoundException
     */
    public function setMessage(string $message): NotFoundException
    {
        $this->message = $message;
        return $this;
    }
}
