<?php

declare(strict_types=1);

namespace App\DTO\Exception;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Not found exception",
 *     description="Not found exception schema"
 * )
 */
final class NotFoundException
{
    private int $code;
    private string $message;

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): NotFoundException
    {
        $this->code = $code;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): NotFoundException
    {
        $this->message = $message;

        return $this;
    }
}
