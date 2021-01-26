<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\ExerciseAdapter;
use App\DTO\Controller\CreateExercise;
use App\DTO\Controller\ExerciseResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use App\Entity\Exercise;
use App\Entity\ExerciseVideo;
use App\Repository\ExerciseRepository;
use App\Repository\UserTrainingRepository;
use App\Exception\UserNotFoundException;

class ExerciseService
{
    private UserTrainingRepository $userTrainingRepository;

    private UserService $userService;

    private EntityManagerInterface $entityManager;

    private ExerciseRepository $exerciseRepository;

    private ValidationService $validationService;

    /**
     * ExerciseService constructor.
     *
     * @param UserTrainingRepository $userTrainingRepository
     * @param UserService            $userService
     * @param EntityManagerInterface $entityManager
     * @param ExerciseRepository     $exerciseRepository
     * @param ValidationService      $validationService
     */
    public function __construct(
        UserTrainingRepository $userTrainingRepository,
        UserService $userService,
        EntityManagerInterface $entityManager,
        ExerciseRepository $exerciseRepository,
        ValidationService $validationService
    ) {
        $this->userTrainingRepository = $userTrainingRepository;
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
     * @param int    $trainingId
     * @param int    $exerciseId
     *
     * @throws UserNotFoundException
     * @throws NonUniqueResultException
     * @throws EntityNotFoundException
     */
    public function attachFile(string $filePath, int $trainingId, int $exerciseId)
    {
        $user = $this->userService->getCurrencyUser();

        $userTraining = $this->userTrainingRepository->findByUserIdAndTrainingId(
            $user->getId(),
            $trainingId
        );

        $exercise = $this->exerciseRepository->findById($exerciseId);

        $exerciseVideo = new ExerciseVideo();
        $exerciseVideo
            ->setVideoPath($filePath)
            ->setUserTrainingId($userTraining->getId())
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
