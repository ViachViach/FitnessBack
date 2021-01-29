<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\ExerciseAdapter;
use App\DTO\Controller\CreateExercise;
use App\DTO\Controller\ExerciseResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Exercise;
use App\Entity\ExerciseVideo;
use App\Repository\ExerciseRepository;
use App\Exception\UserNotFoundException;

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
     * @param ExerciseRepository     $exerciseRepository
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
     *
     * @throws UserNotFoundException
     */
    public function attachFile(string $filePath,  int $exerciseId)
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
     * @param int $exerciseId
     *
     * @return ExerciseResponse
     */
    public function getById(int $exerciseId): ExerciseResponse
    {
        $exercise = $this->exerciseRepository->findById($exerciseId);
        $adapter = new ExerciseAdapter($exercise);
        return $adapter->createResponse();
    }
}
