<?php

declare(strict_types=1);

namespace App\Service;

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
    public function getById(int $id): Nutrition
    {
        $nutrition = $this->nutritionRepository->find($id);

        if ($nutrition === null) {
            throw new EntityNotFoundException(sprintf('Nutrition by %d id not found', $id));
        }



        return $nutrition;
    }

    public function getAll()
    {

    }
}
