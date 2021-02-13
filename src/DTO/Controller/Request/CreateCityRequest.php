<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

final class CreateCityRequest
{
    private string $name;
    private int $count;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateCityRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): CreateCityRequest
    {
        $this->count = $count;
        return $this;
    }
}
