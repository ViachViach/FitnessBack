<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\NutritionAdapter;
use App\DTO\Controller\Request\CreateNutritionRequest;
use App\DTO\Controller\Response\NutritionResponse;
use App\Repository\NutritionRepository;
use Doctrine\ORM\EntityNotFoundException;

class NutritionService
{
    public function __construct(
        private UserService $userService,
        private NutritionRepository $nutritionRepository
    ) { }

    /**
     *
     * @throws EntityNotFoundException
     */
    public function getById(int $id): NutritionResponse
    {
        $nutrition = $this->nutritionRepository->findById($id);

        if ($nutrition === null) {
            throw new EntityNotFoundException(sprintf('Nutrition by %d id not found', $id));
        }

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

    public function delete(int $id): void
    {
    }

    public function create(CreateNutritionRequest $createExercise): NutritionResponse
    {
        return new NutritionResponse();
    }

    public function update(CreateNutritionRequest $createExercise, int $id): NutritionResponse
    {
        return new NutritionResponse();
    }
}
