<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\TrainingAdapter;
use App\DTO\Controller\Response\TrainingResponse;
use App\Exception\UserNotFoundException;
use App\Repository\TrainingRepository;

class TrainingService
{
    public function __construct(
        private TrainingRepository $trainingRepository,
        private UserService $userService
    ) { }

    /**
     * @return TrainingResponse[] array
     *
     * @throws UserNotFoundException
     */
    public function getTrainingsByCurrencyUser(): array
    {
        $user      = $this->userService->getCurrencyUser();
        $trainings = $this->trainingRepository->findByUserId($user->getId());

        $trainingsDto = [];

        foreach ($trainings as $training) {
            $adapter        = new TrainingAdapter($training);
            $trainingsDto[] = $adapter->createResponse();
        }

        return $trainingsDto;
    }
}
