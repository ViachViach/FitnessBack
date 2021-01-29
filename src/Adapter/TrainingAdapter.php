<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\TrainingResponse;
use App\Entity\Training;

class TrainingAdapter
{
    private Training $training;

    public function __construct(Training $training)
    {
        $this->training = $training;
    }

    public function createResponse(Training $training): TrainingResponse
    {
        $trainingDto = new TrainingResponse();
        $trainingDto
            ->setId($training->getId())
            ->setName($training->getName())
            ->setDescription($training->getDescription())
        ;

        $exercises = [];
        foreach ($training->getExercises() as $exercise) {
            $adapter = new ExerciseAdapter($exercise);
            $exercises[] = $adapter->createResponse();
        }

        $trainingDto->setExercises($exercises);

        return $trainingDto;
    }
}
