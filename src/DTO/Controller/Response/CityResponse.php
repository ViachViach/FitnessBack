<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

final class CityResponse
{
    private int $id;
    private string $name;
    private int $countryId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CityResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CityResponse
    {
        $this->name = $name;
        return $this;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): CityResponse
    {
        $this->countryId = $countryId;
        return $this;
    }
}
