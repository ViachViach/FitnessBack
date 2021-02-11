<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\NutritionAdapter;
use App\DTO\Controller\Response\NutritionResponse;
use App\Entity\Nutrition;
use App\Repository\NutritionRepository;
use Doctrine\ORM\EntityNotFoundException;

class NutritionService
{
    private UserService $userService;

    private NutritionRepository $nutritionRepository;

    public function __construct(UserService $userService, NutritionRepository $nutritionRepository)
    {
        $this->userService = $userService;
        $this->nutritionRepository = $nutritionRepository;
    }

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
            $adapter = new NutritionAdapter($item);
            $result[] = $adapter->createResponse();
        }

        return $result;
    }
}
