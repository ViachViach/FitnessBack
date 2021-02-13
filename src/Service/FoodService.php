<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\FoodAdapter;
use App\DTO\Controller\Request\CreateFoodRequest;
use App\DTO\Controller\Response\FoodResponse;
use App\Entity\Food;
use App\Repository\FoodRepository;
use ViachViach\CustomValidationBundle\Service\ValidationServiceInterface;
use ViachViach\ExceptionHandler\Exception\NotFoundException;

class FoodService
{
    public function __construct(
        private FoodRepository $foodRepository,
        private ValidationServiceInterface $validationService,
    ) { }

    public function create(CreateFoodRequest $createFoodRequest): FoodResponse
    {
        $this->validationService->validate($createFoodRequest);
        $food = new Food();
        $food
            ->setName($createFoodRequest->getName())
            ->setCount($createFoodRequest->getCount())
        ;

        $this->validationService->validate($food);
        $this->foodRepository->save($food);

        $adapter = new FoodAdapter($food);
        return $adapter->createResponse();
    }

    public function update(CreateFoodRequest $createFoodRequest, int $id): FoodResponse
    {
        $this->validationService->validate($createFoodRequest);
        $food = $this->getById($id);
        $food
            ->setName($createFoodRequest->getName())
            ->setCount($createFoodRequest->getCount())
        ;

        $this->validationService->validate($food);
        $this->foodRepository->save($food);

        $adapter = new FoodAdapter($food);
        return $adapter->createResponse();
    }

    public function getResponseById(int $id): FoodResponse
    {
        $food = $this->getById($id);

        $adapter = new FoodAdapter($food);
        return $adapter->createResponse();
    }

    /**
     * @return Food[]
    */
    public function getAll(): array
    {
        $foods = $this->foodRepository->findAll();

        $result = [];
        foreach ($foods as $food) {
            $adapter  = new FoodAdapter($food);
            $result[] = $adapter->createResponse();
        }

        return $result;
    }

    public function deleteById(int $id): void
    {
        $food = $this->getById($id);
    }

    public function getById(int $id): Food
    {
        $food = $this->foodRepository->find($id);

        if ($food === null) {
            throw new NotFoundException(sprintf('Food by %d id not found', $id));
        }

        return $food;
    }
}
