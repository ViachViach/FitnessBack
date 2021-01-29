<?php

declare(strict_types=1);

namespace App\DTO\Exception;

final class ValidationException
{
    private int $code;

    /**
     * @var string[]
    */
    private array $errors;

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param string[] $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }
}
