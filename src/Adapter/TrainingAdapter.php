<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\Response\TrainingResponse;
use App\Entity\Training;

class TrainingAdapter
{
    public function __construct(
        private Training $training
    ) { }

    public function createResponse(): TrainingResponse
    {
        $result = new TrainingResponse();
        $result
            ->setId($this->training->getId())
            ->setName($this->training->getName())
            ->setDescription($this->training->getDescription())
        ;

        $exercises = [];

        foreach ($this->training->getExercises() as $exercise) {
            $adapter     = new ExerciseAdapter($exercise);
            $exercises[] = $adapter->createResponse();
        }

        $result->setExercises($exercises);

        return $result;
    }
}
