<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Create food",
 *     description="Create food schema",
 *     required={"name"}
 * )
 */
final class CreateFoodRequest
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Food's name"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     nullable=true,
     *     description="Food's count"
     * )
     */
    private int $count;

    /**
     * @OA\Property(
     *     nullable=true,
     *     description="Food's nutrition id"
     * )
     */
    private int $nutritionId;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateFoodRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): CreateFoodRequest
    {
        $this->count = $count;
        return $this;
    }

    public function getNutritionId(): int
    {
        return $this->nutritionId;
    }

    public function setNutritionId(int $nutritionId): CreateFoodRequest
    {
        $this->nutritionId = $nutritionId;
        return $this;
    }
}
