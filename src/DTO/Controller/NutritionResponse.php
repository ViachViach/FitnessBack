<?php

declare(strict_types=1);

namespace App\DTO\Controller;

final class NutritionResponse
{
    private int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return NutritionResponse
     */
    public function setId(int $id): NutritionResponse
    {
        $this->id = $id;
        return $this;
    }
}
