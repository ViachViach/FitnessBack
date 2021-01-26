<?php

declare(strict_types=1);

namespace App\DTO\Controller;

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
     * @return TrainingResponse
     */
    public function setId(int $id): TrainingResponse
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
     * @return TrainingResponse
     */
    public function setName(string $name): TrainingResponse
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
     * @return TrainingResponse
     */
    public function setDescription(string $description): TrainingResponse
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeekDay(): int
    {
        return $this->weekDay;
    }

    /**
     * @param int $weekDay
     *
     * @return TrainingResponse
     */
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
     * @return TrainingResponse
     */
    public function setExercises(array $exercises): TrainingResponse
    {
        $this->exercises = $exercises;
        return $this;
    }
}
