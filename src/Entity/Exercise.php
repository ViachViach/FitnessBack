<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExerciseRepository")
 */
class Exercise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Column(type="string", length=255, name="video_path", nullable=true)
    */
    private string $videoPath;

    /**
     * @ORM\OneToOne(targetEntity="ExerciseVideo", mappedBy="exercise")
    */
    private ExerciseVideo $video;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="App\Entity\Training",
     *     inversedBy="exercises",
     *     cascade={"persist"}
     * )
     * @ORM\JoinTable(
     *     name="public.training_exercise",
     *     joinColumns={
     *          @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *          @ORM\JoinColumn(name="exercise_id", referencedColumnName="id")
     *     }
     * )
     */
    private Collection $trainings;

    public function __construct()
    {
        $this->trainings = new ArrayCollection();
    }

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
     * @return Exercise
     */
    public function setId(int $id): Exercise
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
     * @return Exercise
     */
    public function setName(string $name): Exercise
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
     * @return Exercise
     */
    public function setDescription(string $description): Exercise
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
     * @return Exercise
     */
    public function setVideoPath(string $videoPath): Exercise
    {
        $this->videoPath = $videoPath;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    /**
     * @param Collection $trainings
     *
     * @return Exercise
     */
    public function setTrainings(Collection $trainings): Exercise
    {
        $this->trainings = $trainings;
        return $this;
    }

    /**
     * @return ExerciseVideo
     */
    public function getVideo(): ExerciseVideo
    {
        return $this->video;
    }

    /**
     * @param ExerciseVideo $video
     *
     * @return Exercise
     */
    public function setVideo(ExerciseVideo $video): Exercise
    {
        $this->video = $video;
        return $this;
    }
}
