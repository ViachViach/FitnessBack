<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

final class CountryResponse
{
    private int $id;
    private string $name;

    /**
     * @var CityResponse[]
    */
    private array $cities;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CountryResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CountryResponse
    {
        $this->name = $name;
        return $this;
    }

    public function getCities(): array
    {
        return $this->cities;
    }

    public function setCities(array $cities): CountryResponse
    {
        $this->cities = $cities;
        return $this;
    }
}
