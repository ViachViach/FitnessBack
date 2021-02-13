<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Food response",
 *     description="Food response schema"
 * )
 */
final class FoodResponse
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Food's id"
     * )
     */
    private int $id;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Food's name"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Food's count"
     * )
     */
    private int $count;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Nutrition"
     * )
     */
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
