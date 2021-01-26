<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\UserNotFoundException;
use App\DTO\Controller\TrainingResponse;
use App\Entity\UserTraining;
use App\Repository\UserTrainingRepository;

class TrainingService
{
    private UserTrainingRepository $userTrainingRepository;

    private ExerciseService $exerciseService;

    private UserService $userService;

    public function __construct(
        UserTrainingRepository $userTrainingRepository,
        ExerciseService $exerciseService,
        UserService $userService
    ) {
        $this->userTrainingRepository = $userTrainingRepository;
        $this->exerciseService = $exerciseService;
        $this->userService = $userService;
    }

    /**
     * @return TrainingResponse[] array
     *
     * @throws UserNotFoundException
     */
    public function getTrainingsByCurrencyUser(): array
    {
        $user = $this->userService->getCurrencyUser();
        $userTrainings = $this->userTrainingRepository->findByUserId($user->getId());

        $trainingsDto = [];
        foreach ($userTrainings as $userTraining) {
            $trainingsDto[] = $this->createDto($userTraining);
        }

        return $trainingsDto;
    }
    
    /**
     * @param UserTraining $userTraining
     *
     * @return TrainingResponse
     */
    private function createDto(UserTraining $userTraining): TrainingResponse
    {
        $trainingDto = new TrainingResponse();
        $trainingDto->setId($userTraining->getTraining()->getId());
        $trainingDto->setName($userTraining->getTraining()->getName());
        $trainingDto->setDescription($userTraining->getTraining()->getDescription());
        $trainingDto->setWeekDay($userTraining->getWeekDay());

        $exercisesDto = $this->exerciseService->getAll($userTraining->getTraining()->getExercises());
        $trainingDto->setExercises($exercisesDto);

        return $trainingDto;
    }
}
