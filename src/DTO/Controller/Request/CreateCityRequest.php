<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

final class CreateCityRequest
{
    private string $name;
    private int $countryId;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateCityRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): CreateCityRequest
    {
        $this->countryId = $countryId;
        return $this;
    }
}
