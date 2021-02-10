<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

final class NutritionResponse
{
    private int $id;
    private string $name;
    private string $description;
    private int $mill;
    private int $calories;
    private int $protein;

    /**
     * @var array<FoodResponse>
    */
    private array $foods;

    /**
     * @var array<TrainingNutritionResponse>
     */
    private array $TrainingNutrition;


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): NutritionResponse
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return NutritionResponse
     */
    public function setName(string $name): NutritionResponse
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return NutritionResponse
     */
    public function setDescription(string $description): NutritionResponse
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getMill(): int
    {
        return $this->mill;
    }

    /**
     * @param string $mill
     *
     * @return NutritionResponse
     */
    public function setMill(int $mill): NutritionResponse
    {
        $this->mill = $mill;
        return $this;
    }

    /**
     * @return int
     */
    public function getCalories(): int
    {
        return $this->calories;
    }

    /**
     * @param int $calories
     *
     * @return NutritionResponse
     */
    public function setCalories(int $calories): NutritionResponse
    {
        $this->calories = $calories;
        return $this;
    }

    /**
     * @return int
     */
    public function getProtein(): int
    {
        return $this->protein;
    }

    /**
     * @param int $protein
     *
     * @return NutritionResponse
     */
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
     * @return NutritionResponse
     */
    public function setFoods(array $foods): NutritionResponse
    {
        $this->foods = $foods;
        return $this;
    }

    /**
     * @return TrainingNutritionResponse[]
     */
    public function getTrainingNutrition(): array
    {
        return $this->TrainingNutrition;
    }

    /**
     * @param TrainingNutritionResponse[] $TrainingNutrition
     *
     * @return NutritionResponse
     */
    public function setTrainingNutrition(array $TrainingNutrition): NutritionResponse
    {
        $this->TrainingNutrition = $TrainingNutrition;
        return $this;
    }
}
