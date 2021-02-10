<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\Response\NutritionResponse;
use App\Entity\Nutrition;

class NutritionAdapter
{
    private Nutrition $nutrition;

    public function __construct(Nutrition $nutrition)
    {
        $this->nutrition = $nutrition;
    }

    public function createResponse(): NutritionResponse
    {
        $nutritionResponse = new NutritionResponse();
        $nutritionResponse
            ->setId($this->nutrition->getId())
            ->setName($this->nutrition->getName())
            ->setCalories($this->nutrition->getCalories())
            ->setDescription($this->nutrition->getDescription())
            ->setMill($this->nutrition->getMill())
            ->setProtein($this->nutrition->getProtein())
        ;

        return $nutritionResponse;
    }
}
