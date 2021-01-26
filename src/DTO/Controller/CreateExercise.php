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
     * @return CreateExercise
     */
    public function setId(int $id): CreateExercise
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return CreateExercise
     */
    public function setName(string $name): CreateExercise
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return CreateExercise
     */
    public function setDescription(string $description): CreateExercise
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideoPath(): string
    {
        return $this->videoPath;
    }

    /**
     * @param string $videoPath
     *
     * @return CreateExercise
     */
    public function setVideoPath(string $videoPath): CreateExercise
    {
        $this->videoPath = $videoPath;
        return $this;
    }
}
