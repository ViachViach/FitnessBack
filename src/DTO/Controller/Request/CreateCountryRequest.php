<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

final class CreateCountryRequest
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateCountryRequest
    {
        $this->name = $name;
        return $this;
    }
}
