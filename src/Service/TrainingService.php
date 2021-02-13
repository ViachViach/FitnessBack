<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\TrainingAdapter;
use App\DTO\Controller\Request\CreateTrainingRequest;
use App\DTO\Controller\Response\TrainingResponse;
use App\Entity\Training;
use App\Exception\UserNotFoundException;
use App\Repository\TrainingRepository;
use ViachViach\ExceptionHandler\Exception\NotFoundException;

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

        $result = [];
        foreach ($trainings as $training) {
            $adapter  = new TrainingAdapter($training);
            $result[] = $adapter->createResponse();
        }

        return $result;
    }

    public function crete(CreateTrainingRequest $createTrainingRequest): TrainingResponse
    {
        $training = new Training();
        $training
            ->setName($createTrainingRequest->getName())
            ->setDescription($createTrainingRequest->getDescription())
        ;

        $this->trainingRepository->save($training);

        $adapter = new TrainingAdapter($training);
        return $adapter->createResponse();
    }

    public function update(CreateTrainingRequest $createTrainingRequest, int $id): TrainingResponse
    {
        $training = $this->getById($id);
        $training
            ->setName($createTrainingRequest->getName())
            ->setDescription($createTrainingRequest->getDescription())
        ;

        $this->trainingRepository->save($training);

        $adapter = new TrainingAdapter($training);
        return $adapter->createResponse();
    }

    public function getResponseById(int $id): TrainingResponse
    {
        $training = $this->getById($id);

        $adapter = new TrainingAdapter($training);
        return $adapter->createResponse();
    }

    /**
     * @return TrainingResponse[]
     */
    public function getAll(): array
    {
        $trainings = $this->trainingRepository->findAll();

        $result = [];
        foreach ($trainings as $training) {
            $adapter  = new TrainingAdapter($training);
            $result[] = $adapter->createResponse();
        }

        return $result;
    }

    public function delete(int $id): void
    {
        $training = $this->getById($id);
    }

    /**
     * @throws NotFoundException
    */
    public function getById(int $id): Training
    {
        $training = $this->trainingRepository->find($id);

        if ($training === null) {
            throw new NotFoundException(sprintf("Training by %d id not found", $id));
        }

        return $training;
    }
}
