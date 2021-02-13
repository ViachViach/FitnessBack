<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Create training",
 *     description="Create training schema",
 *     required={"name", "description"}
 * )
 */
final class CreateTrainingRequest
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Training's name"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Training's description"
     * )
     */
    private string $description;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateTrainingRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): CreateTrainingRequest
    {
        $this->description = $description;
        return $this;
    }
}
