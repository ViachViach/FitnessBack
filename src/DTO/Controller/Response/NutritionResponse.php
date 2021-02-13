<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Nutrition response",
 *     description="Nutrition response schema"
 * )
 */
final class NutritionResponse
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Nutrition's id"
     * )
     */
    private int $id;

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

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Foods"
     * )
     * @var array<FoodResponse>
    */
    private array $foods;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Trainings"
     * )
     * @var array<TrainingResponse>
     */
    private array $trainings;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): NutritionResponse
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): NutritionResponse
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): NutritionResponse
    {
        $this->description = $description;

        return $this;
    }

    public function getMill(): int
    {
        return $this->mill;
    }

    public function setMill(int $mill): NutritionResponse
    {
        $this->mill = $mill;

        return $this;
    }

    public function getCalories(): int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): NutritionResponse
    {
        $this->calories = $calories;

        return $this;
    }

    public function getProtein(): int
    {
        return $this->protein;
    }

    public function setProtein(int $protein): NutritionResponse
    {
        $this->protein = $protein;

        return $this;
    }

    /**
     * @return FoodResponse[]
     */
    public function getFoods(): array
    {
        return $this->foods;
    }

    /**
     * @param FoodResponse[] $foods
     *
     */
    public function setFoods(array $foods): NutritionResponse
    {
        $this->foods = $foods;

        return $this;
    }

    /**
     * @return TrainingResponse[]
     */
    public function getTraining(): array
    {
        return $this->trainings;
    }

    /**
     * @param TrainingResponse[] $trainings
     *
     */
    public function setTraining(array $trainings): NutritionResponse
    {
        $this->trainings = $trainings;

        return $this;
    }
}
