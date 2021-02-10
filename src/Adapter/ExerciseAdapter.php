<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\Response\ExerciseResponse;
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
        $exerciseResponse = new ExerciseResponse();
        $exerciseResponse->setId($this->exercise->getId())
            ->setName($this->exercise->getName())
            ->setDescription($this->exercise->getDescription())
            ->setUpdateAt($this->exercise->getUpdateAt())
            ->setCreateAt($this->exercise->getCreateAt())
        ;

        return $exerciseResponse;
    }
}
