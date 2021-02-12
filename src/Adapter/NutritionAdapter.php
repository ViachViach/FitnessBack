<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\Response\NutritionResponse;
use App\Entity\Nutrition;

class NutritionAdapter
{
    public function __construct(
        private Nutrition $nutrition
    ) { }

    public function createResponse(): NutritionResponse
    {
        $nutritionResponse = new NutritionResponse();
        $nutritionResponse
            ->setId($this->nutrition->getId())
            ->setName($this->nutrition->getName())
            ->setCalories($this->nutrition->getCalories())
            ->setDescription($this->nutrition->getDescription())
            ->setMill($this->nutrition->getMill())
            ->setProtein($this->nutrition->getProtein());

        $trainings = [];
        $foods     = [];

        foreach ($this->nutrition->getTrainingNutrition() as $trainingNutrition) {
            $adapter     = new TrainingAdapter($trainingNutrition->training);
            $trainings[] = $adapter->createResponse();
        }

        foreach ($this->nutrition->getFoods() as $food) {
            $adapter = new FoodAdapter($food);
            $foods[] = $adapter->createResponse();
        }

        $nutritionResponse
            ->setTraining($trainings)
            ->setFoods($foods);

        return $nutritionResponse;
    }
}
