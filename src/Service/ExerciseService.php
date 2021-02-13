<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\ExerciseAdapter;
use App\DTO\Controller\Request\CreateExerciseRequest;
use App\DTO\Controller\Response\ExerciseResponse;
use App\Entity\Exercise;
use App\Entity\ExerciseVideo;
use App\Repository\ExerciseRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use ViachViach\CustomValidationBundle\Service\ValidationServiceInterface;
use ViachViach\ExceptionHandler\Exception\NotFoundException;

class ExerciseService
{
    public function __construct(
        private UserService $userService,
        private EntityManagerInterface $entityManager,
        private ExerciseRepository $exerciseRepository,
        private ValidationServiceInterface $validationService
    ) { }

    /**
     * @throws NotFoundException
     */
    public function getById(int $id): Exercise
    {
        $exercise = $this->exerciseRepository->findById($id);

        if ($exercise === null) {
            throw new NotFoundException(sprintf("Exercise by %d id not found", $id));
        }

        return $exercise;
    }

    /**
     * @return ExerciseResponse[]
     */
    public function getAll(): array
    {
        $exercises = $this->exerciseRepository->findAllExisting();

        $result = [];

        foreach ($exercises as $exercise) {
            $adapter  = new ExerciseAdapter($exercise);
            $result[] = $adapter->createResponse();
        }

        return $result;
    }

    public function attachFile(string $filePath, int $exerciseId): void
    {
        $exercise = $this->exerciseRepository->findById($exerciseId);

        $exerciseVideo = new ExerciseVideo();
        $exerciseVideo
            ->setVideoPath($filePath)
            ->setExercise($exercise);

        $this->validationService->validate($exerciseVideo);
        $this->entityManager->persist($exerciseVideo);
        $this->entityManager->flush();
    }

    public function create(CreateExerciseRequest $createExercise): ExerciseResponse
    {
        $this->validationService->validate($createExercise);

        $exercise = new Exercise();
        $exercise
            ->setName($createExercise->getName())
            ->setDescription($createExercise->getDescription())
            ->setUpdateAt(new DateTime())
            ->setCreateAt(new DateTime());

        $this->validationService->validate($exercise);
        $this->exerciseRepository->save($exercise);

        $adapter = new ExerciseAdapter($exercise);

        return $adapter->createResponse();
    }

    public function update(CreateExerciseRequest $createExercise, int $id): ExerciseResponse
    {
        $this->validationService->validate($createExercise);
        $exercise = $this->getById($id);
        $exercise
            ->setName($createExercise->getName())
            ->setDescription($createExercise->getDescription())
            ->setUpdateAt(new DateTime())
        ;

        $this->validationService->validate($exercise);
        $this->exerciseRepository->save($exercise);

        $adapter = new ExerciseAdapter($exercise);

        return $adapter->createResponse();
    }

    /**
     *
     * @throws EntityNotFoundException
     */
    public function getResponseById(int $id): ExerciseResponse
    {
        $exercise = $this->getById($id);
        $adapter  = new ExerciseAdapter($exercise);

        return $adapter->createResponse();
    }

    public function deleteById(int $id): void
    {
        $exercise = $this->getById($id);

        $exercise
            ->setDeletedAt(new DateTime())
            ->setUpdateAt(new DateTime());

        $this->exerciseRepository->save($exercise);
    }
}
