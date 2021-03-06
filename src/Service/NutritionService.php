<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\NutritionAdapter;
use App\DTO\Controller\Request\CreateNutritionRequest;
use App\DTO\Controller\Response\NutritionResponse;
use App\Entity\Nutrition;
use App\Repository\NutritionRepository;
use ViachViach\CustomValidationBundle\Service\ValidationServiceInterface;
use DateTime;
use ViachViach\Storage\Exception\NotFoundException;

class NutritionService
{
    public function __construct(
        private UserService $userService,
        private NutritionRepository $nutritionRepository,
        private ValidationServiceInterface $validationService,
    ) { }

    public function getResponseById(int $id): NutritionResponse
    {
        $nutrition = $this->getById($id);

        $adapter = new NutritionAdapter($nutrition);

        return $adapter->createResponse();
    }

    /**
     * @return NutritionResponse[]
    */
    public function getAll(): array
    {
        $nutrition = $this->nutritionRepository->findAllExisting();

        $result = [];

        foreach ($nutrition as $item) {
            $adapter  = new NutritionAdapter($item);
            $result[] = $adapter->createResponse();
        }

        return $result;
    }

    public function deleteById(int $id): void
    {
        $nutrition = $this->getById($id);

        $nutrition
            ->setUpdateAt(new DateTime())
            ->setDeletedAt(new DateTime())
        ;

        $this->nutritionRepository->save($nutrition);
    }

    public function create(CreateNutritionRequest $createExercise): NutritionResponse
    {
        $this->validationService->validate($createExercise);

        $nutrition = new Nutrition();
        $nutrition
            ->setName($createExercise->getName())
            ->setDescription($createExercise->getDescription())
            ->setMill($createExercise->getMill())
            ->setCalories($createExercise->getCalories())
            ->setProtein($createExercise->getProtein())
            ->setCreateAt(new DateTime())
            ->setUpdateAt(new DateTime())
        ;

        $this->validationService->validate($nutrition);
        $this->nutritionRepository->save($nutrition);

        $adapter = new NutritionAdapter($nutrition);
        return $adapter->createResponse();
    }

    public function update(CreateNutritionRequest $createExercise, int $id): NutritionResponse
    {
        $this->validationService->validate($createExercise);

        $nutrition = $this->getById($id);
        $nutrition
            ->setName($createExercise->getName())
            ->setDescription($createExercise->getDescription())
            ->setMill($createExercise->getMill())
            ->setCalories($createExercise->getCalories())
            ->setProtein($createExercise->getProtein())
            ->setUpdateAt(new DateTime())
        ;

        $this->validationService->validate($nutrition);
        $this->nutritionRepository->save($nutrition);

        $adapter = new NutritionAdapter($nutrition);
        return $adapter->createResponse();
    }

    /**
     * @throws NotFoundException
     */
    public function getById(int $id): Nutrition
    {
        $nutrition = $this->nutritionRepository->findById($id);

        if ($nutrition === null) {
            throw new NotFoundException(sprintf('Nutrition by %d id not found', $id));
        }

        return $nutrition;
    }
}
