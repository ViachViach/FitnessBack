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
    private int $id;

    /**
     * @OA\Property(
     *     nullable=true,
     *     description="Exercise's name"
     * )
     */
    private string $name;

    private string $description;

    private string $videoPath = '';

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CreateExercise
    {
        $this->id = $id;

        return $this;
    }

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

    public function getVideoPath(): string
    {
        return $this->videoPath;
    }

    public function setVideoPath(string $videoPath): CreateExercise
    {
        $this->videoPath = $videoPath;

        return $this;
    }
}
