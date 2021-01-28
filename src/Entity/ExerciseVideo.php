<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="integer", nullable=false, name="user_training_id")
     */
    private int $userTrainingId;

    /**
     * @ORM\OneToOne(targetEntity="Exercise")
     * @ORM\JoinColumn(columnDefinition="exercise_id", referencedColumnName="id")
     */
    private Exercise $exercise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $videoPath;

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
     * @return ExerciseVideo
     */
    public function setId(int $id): ExerciseVideo
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserTrainingId(): int
    {
        return $this->userTrainingId;
    }

    /**
     * @param int $userTrainingId
     *
     * @return ExerciseVideo
     */
    public function setUserTrainingId(int $userTrainingId): ExerciseVideo
    {
        $this->userTrainingId = $userTrainingId;
        return $this;
    }

    /**
     * @return Exercise
     */
    public function getExercise(): Exercise
    {
        return $this->exercise;
    }

    /**
     * @param Exercise $exercise
     *
     * @return ExerciseVideo
     */
    public function setExercise(Exercise $exercise): ExerciseVideo
    {
        $this->exercise = $exercise;
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
     * @return ExerciseVideo
     */
    public function setVideoPath(string $videoPath): ExerciseVideo
    {
        $this->videoPath = $videoPath;
        return $this;
    }
}
