<?php

declare(strict_types=1);

namespace App\DTO\Controller;

final class ExerciseResponse
{
    private int $id;

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
     * @return ExerciseResponse
     */
    public function setId(int $id): ExerciseResponse
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
     * @return ExerciseResponse
     */
    public function setName(string $name): ExerciseResponse
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
     * @return ExerciseResponse
     */
    public function setDescription(string $description): ExerciseResponse
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
     * @return ExerciseResponse
     */
    public function setVideoPath(string $videoPath): ExerciseResponse
    {
        $this->videoPath = $videoPath;
        return $this;
    }
}
