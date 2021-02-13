<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Training response",
 *     description="Training response schema"
 * )
 */
final class TrainingResponse
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Training's id"
     * )
     */
    private int $id;

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

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Training's week day"
     * )
     */
    private int $weekDay;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Exercises"
     * )
     * @var ExerciseResponse[]
    */
    private array $exercises;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): TrainingResponse
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TrainingResponse
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): TrainingResponse
    {
        $this->description = $description;

        return $this;
    }

    public function getWeekDay(): int
    {
        return $this->weekDay;
    }

    public function setWeekDay(int $weekDay): TrainingResponse
    {
        $this->weekDay = $weekDay;

        return $this;
    }

    /**
     * @return ExerciseResponse[]
     */
    public function getExercises(): array
    {
        return $this->exercises;
    }

    /**
     * @param ExerciseResponse[] $exercises
     *
     */
    public function setExercises(array $exercises): TrainingResponse
    {
        $this->exercises = $exercises;

        return $this;
    }
}
