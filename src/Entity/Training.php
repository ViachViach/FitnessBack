<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrainingRepository")
 */
class Training
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
     * @ORM\Column(type="text", nullable=true)
     */
    private string $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User::class", inversedBy="trainings", cascade={"persist"})
     * @ORM\JoinTable(
     *     name="public.user_training",
     *     joinColumns={
     *          @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *          @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *     }
     * )
     */
    private Collection $users;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Exercise", inversedBy="trainings")
     */
    private Collection $exercises;

    /**
     * @ORM\OneToMany(targetEntity="TrainingNutrition", mappedBy="nutrition")
     */
    private Collection $trainingNutrition;

    public function __construct()
    {
        $this->exercises = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->trainingNutrition = new ArrayCollection();
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
     * @return Training
     */
    public function setId(int $id): Training
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
     * @return Training
     */
    public function setName(string $name): Training
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
     * @return Training
     */
    public function setDescription(string $description): Training
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param Collection $users
     *
     * @return Training
     */
    public function setUsers(Collection $users): Training
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getExercises(): Collection
    {
        return $this->exercises;
    }

    /**
     * @param Collection $exercises
     *
     * @return Training
     */
    public function setExercises(Collection $exercises): Training
    {
        $this->exercises = $exercises;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getTrainingNutrition(): Collection
    {
        return $this->trainingNutrition;
    }

    /**
     * @param Collection $trainingNutrition
     *
     * @return Training
     */
    public function setTrainingNutrition(Collection $trainingNutrition): Training
    {
        $this->trainingNutrition = $trainingNutrition;
        return $this;
    }
}
