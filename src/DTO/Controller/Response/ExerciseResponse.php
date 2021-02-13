<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

use DateTimeInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Exercise response",
 *     description="Exercise response schema"
 * )
 */
final class ExerciseResponse
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Exercise's id"
     * )
     */
    private int $id;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Exercise's name"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Exercise's description"
     * )
     */
    private string $description;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Exercise's video path"
     * )
     */
    private string $videoPath;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="date create"
     * )
     */
    private DateTimeInterface $createAt;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="date update"
     * )
     */
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
