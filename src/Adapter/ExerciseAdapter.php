<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\ExerciseResponse;
use App\Entity\Exercise;

class ExerciseAdapter
{
    private Exercise $exercise;

    public function __construct(Exercise $exercise)
    {
        $this->exercise = $exercise;
    }

    public function createResponse(): ExerciseResponse
    {
        $exerciseDto = new ExerciseResponse();
        $exerciseDto->setId($this->exercise->getId());
        $exerciseDto->setName($this->exercise->getName());
        $exerciseDto->setDescription($this->exercise->getDescription());

        return $exerciseDto;
    }
}
