<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

use DateTimeInterface;

final class ExerciseResponse
{
    private int $id;
    private string $name;
    private string $description;
    private string $videoPath;
    private DateTimeInterface $createAt;
    private DateTimeInterface $updateAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ExerciseResponse
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ExerciseResponse
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): ExerciseResponse
    {
        $this->description = $description;

        return $this;
    }

    public function getVideoPath(): string
    {
        return $this->videoPath;
    }

    public function setVideoPath(string $videoPath): ExerciseResponse
    {
        $this->videoPath = $videoPath;

        return $this;
    }

    public function getCreateAt(): DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(DateTimeInterface $createAt): ExerciseResponse
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeInterface $updateAt): ExerciseResponse
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}
