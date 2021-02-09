<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

final class TrainingResponse
{
    private int $id;

    private string $name;

    private string $description;

    private int $weekDay;

    /**
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
