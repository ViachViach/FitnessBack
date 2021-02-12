<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

final class CreateNutritionRequest
{
    private string $name;
    private string $description;
    private int $mill;
    private int $calories;
    private int $protein;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateNutritionRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): CreateNutritionRequest
    {
        $this->description = $description;
        return $this;
    }

    public function getMill(): int
    {
        return $this->mill;
    }

    public function setMill(int $mill): CreateNutritionRequest
    {
        $this->mill = $mill;
        return $this;
    }

    public function getCalories(): int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): CreateNutritionRequest
    {
        $this->calories = $calories;
        return $this;
    }

    public function getProtein(): int
    {
        return $this->protein;
    }

    public function setProtein(int $protein): CreateNutritionRequest
    {
        $this->protein = $protein;
        return $this;
    }
}
