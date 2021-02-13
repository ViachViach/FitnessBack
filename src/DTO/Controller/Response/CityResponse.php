<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

final class CityResponse
{
    private int $id;
    private string $name;
    private int $cityId;

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

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function setCityId(int $cityId): CityResponse
    {
        $this->cityId = $cityId;
        return $this;
    }
}
