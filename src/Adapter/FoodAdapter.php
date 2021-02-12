<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\Response\FoodResponse;
use App\Entity\Food;

class FoodAdapter
{
    public function __construct(
        private Food $food
    ) { }

    public function createResponse(): FoodResponse
    {
        $foodResponse = new FoodResponse();
        $foodResponse
            ->setId($this->food->getId())
            ->setName($this->food->getName())
            ->setCount($this->food->getCount());

        return $foodResponse;
    }
}
