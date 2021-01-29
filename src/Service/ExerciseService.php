<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\ExerciseAdapter;
use App\DTO\Controller\CreateExercise;
use App\DTO\Controller\ExerciseResponse;
use App\Repository\ExerciseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Exercise;
use App\Entity\ExerciseVideo;
use Doctrine\ORM\EntityNotFoundException;

class ExerciseService
{
    private UserService $userService;

    private EntityManagerInterface $entityManager;

    private ExerciseRepository $exerciseRepository;

    private ValidationService $validationService;

    /**
     * ExerciseService constructor.
     *
     * @param UserService            $userService
     * @param EntityManagerInterface $entityManager
     * @param ExerciseRepository $exerciseRepository
     * @param ValidationService      $validationService
     */
    public function __construct(
        UserService $userService,
        EntityManagerInterface $entityManager,
        ExerciseRepository $exerciseRepository,
        ValidationService $validationService
    ) {
        $this->userService = $userService;
        $this->entityManager = $entityManager;
        $this->exerciseRepository = $exerciseRepository;
        $this->validationService = $validationService;
    }

    /**
     * @param int $id
     *
     * @return Exercise
     * @throws EntityNotFoundException
     */
    public function getById(int $id): Exercise
    {
        $exercise = $this->exerciseRepository->findById($id);

        if ($exercise === null) {
            throw new EntityNotFoundException(sprintf("Exercise by %d id not found", $id));
        }

        return $exercise;
    }

    /**
     * @return ExerciseResponse[]
     */
    public function getAll(): array
    {
        $exercises = $this->exerciseRepository->findAll();

        $result = [];
        foreach ($exercises as $exercise) {
            $adapter = new ExerciseAdapter($exercise);
            $result[] = $adapter->createResponse();
        }

        return $result;
    }


    /**
     * @param string $filePath
     * @param int    $exerciseId
     */
    public function attachFile(string $filePath, int $exerciseId): void
    {
        $exercise = $this->exerciseRepository->findById($exerciseId);

        $exerciseVideo = new ExerciseVideo();
        $exerciseVideo
            ->setVideoPath($filePath)
            ->setExercise($exercise)
        ;

        $this->validationService->validate($exerciseVideo);
        $this->entityManager->persist($exerciseVideo);
        $this->entityManager->flush();
    }

    /**
     * @param CreateExercise $createExercise
     */
    public function create(CreateExercise $createExercise): void
    {
        $exercise = new Exercise();
        $exercise
            ->setName($createExercise->getName())
            ->setDescription($createExercise->getDescription())
        ;

        $this->entityManager->persist($exercise);
        $this->entityManager->flush();
    }

    /**
     * @param int $id
     *
     * @return ExerciseResponse
     * @throws EntityNotFoundException
     */
    public function getResponseById(int $id): ExerciseResponse
    {
        $exercise = $this->getById($id);
        $adapter = new ExerciseAdapter($exercise);
        return $adapter->createResponse();
    }
}
