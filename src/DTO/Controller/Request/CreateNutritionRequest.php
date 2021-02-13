<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Create nutrition",
 *     description="Create nutrition schema",
 *     required={"name", "description", "mill", "calories", "protein"}
 * )
 */
final class CreateNutritionRequest
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Nutrition's name"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Nutrition's description"
     * )
     */
    private string $description;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Nutrition's mill"
     * )
     */
    private int $mill;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Nutrition's calories"
     * )
     */
    private int $calories;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Nutrition's protein"
     * )
     */
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
