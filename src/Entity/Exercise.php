<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
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
     * @ORM\Column(type="datetimetz", options={"default": "CURRENT_TIMESTAMP"})
     */
    private DateTimeInterface $createAt;

    /**
     * @ORM\Column(type="datetimetz", options={"default": "CURRENT_TIMESTAMP"})
     */
    private DateTimeInterface $updateAt;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private DateTimeInterface $deletedAt;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="App\Entity\Training",
     *     inversedBy="exercises",
     *     cascade={"persist"}
     * )
     * @ORM\JoinTable(
     *     name="public.training_exercise",
     *     joinColumns={
     *         @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="exercise_id", referencedColumnName="id")
     *     }
     * )
     */
    private Collection $trainings;

    public function __construct()
    {
        $this->trainings = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Exercise
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Exercise
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Exercise
    {
        $this->description = $description;

        return $this;
    }

    public function getVideoPath(): string
    {
        return $this->videoPath;
    }

    public function setVideoPath(string $videoPath): Exercise
    {
        $this->videoPath = $videoPath;

        return $this;
    }

    public function getTrainings(): Collection
    {
        if (!$this->trainings instanceof Selectable) {
            return $this->trainings;
        }

        $criteria = Criteria::create()
            ->andWhere(Criteria::expr()->isNull('deletedAt'))
        ;

        return $this->trainings->matching($criteria);
    }

    public function setTrainings(Collection $trainings): Exercise
    {
        $this->trainings = $trainings;

        return $this;
    }

    public function getVideo(): ExerciseVideo
    {
        return $this->video;
    }

    public function setVideo(ExerciseVideo $video): Exercise
    {
        $this->video = $video;

        return $this;
    }

    public function getCreateAt(): DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(DateTimeInterface $createAt): Exercise
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeInterface $updateAt): Exercise
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getDeleteAt(): DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeleteAt(DateTimeInterface $deletedAt): Exercise
    {
        $this->deleteAt = $deletedAt;

        return $this;
    }
}
