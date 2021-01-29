<?php

declare(strict_types=1);

namespace App\DTO\Controller;

final class NutritionResponse
{
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): NutritionResponse
    {
        $this->id = $id;

        return $this;
    }
}
