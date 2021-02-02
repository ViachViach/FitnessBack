<?php

declare(strict_types=1);

namespace App\DTO\Controller;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Create excercise",
 *     description="Create excercise schema",
 *     required={"name", "description"}
 * )
 */
final class CreateExercise
{
    /**
     * @OA\Property(
     *     nullable=true,
     *     description="Exercise's name"
     * )
     */
    private string $name;

    private string $description;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateExercise
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): CreateExercise
    {
        $this->description = $description;

        return $this;
    }
}
