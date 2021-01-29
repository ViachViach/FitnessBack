<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciseVideoRepository")
 * @UniqueEntity(
 *      fields={"userTrainingId", "exerciseId"},
 *      message="Video alresy exist."
 * )
 */
class ExerciseVideo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity="Exercise", mappedBy="video")
     */
    private Exercise $exercise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $videoPath;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ExerciseVideo
    {
        $this->id = $id;

        return $this;
    }

    public function getExercise(): Exercise
    {
        return $this->exercise;
    }

    public function setExercise(Exercise $exercise): ExerciseVideo
    {
        $this->exercise = $exercise;

        return $this;
    }

    public function getVideoPath(): string
    {
        return $this->videoPath;
    }

    public function setVideoPath(string $videoPath): ExerciseVideo
    {
        $this->videoPath = $videoPath;

        return $this;
    }
}
