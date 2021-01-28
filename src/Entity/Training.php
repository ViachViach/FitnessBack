<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\User;
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
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="trainings", cascade={"persist"})
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

    private UserTraining $userTraining;

    public function __construct()
    {
        $this->exercises = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * @return ArrayCollection|Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param ArrayCollection|Collection $users
     *
     * @return Training
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getExercises()
    {
        return $this->exercises;
    }

    /**
     * @param ArrayCollection|Collection $exercises
     *
     * @return Training
     */
    public function setExercises($exercises)
    {
        $this->exercises = $exercises;
        return $this;
    }

    /**
     * @return UserTraining
     */
    public function getUserTraining(): UserTraining
    {
        return $this->userTraining;
    }

    /**
     * @param UserTraining $userTraining
     *
     * @return Training
     */
    public function setUserTraining(UserTraining $userTraining): Training
    {
        $this->userTraining = $userTraining;
        return $this;
    }
}
