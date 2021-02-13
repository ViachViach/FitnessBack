<?php

declare(strict_types=1);

namespace App\DTO\Exception;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Unauthorized exception",
 *     description="Unauthorized exception schema"
 * )
 */
final class UnauthorizedException
{
    private int $code;
    private string $message;

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
