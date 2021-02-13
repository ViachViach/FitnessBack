<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

final class CreateCityRequest
{
    private string $name;
    private int $city;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateCityRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getCity(): int
    {
        return $this->city;
    }

    public function setCity(int $city): CreateCityRequest
    {
        $this->city = $city;
        return $this;
    }
}
