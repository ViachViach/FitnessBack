<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

final class FoodResponse
{
    private int $id;
    private string $name;
    private int $count;
    private NutritionResponse $nutrition;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): FoodResponse
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): FoodResponse
    {
        $this->name = $name;

        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): FoodResponse
    {
        $this->count = $count;

        return $this;
    }

    public function getNutrition(): NutritionResponse
    {
        return $this->nutrition;
    }

    public function setNutrition(NutritionResponse $nutrition): FoodResponse
    {
        $this->nutrition = $nutrition;

        return $this;
    }
}
