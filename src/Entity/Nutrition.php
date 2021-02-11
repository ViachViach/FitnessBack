<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NutritionRepository")
 */
class Nutrition
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
     * @ORM\Column(type="text", nullable=false)
     */
    private string $description;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $mill;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $calories;

    /**
     * @ORM\Column(type="integer")
     */
    private int $protein;

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
     * @ORM\OneToMany(targetEntity="Food", mappedBy="nutrition")
    */
    private Collection $foods;

    /**
     * @ORM\OneToMany(targetEntity="TrainingNutrition", mappedBy="nutrition")
     */
    private Collection $trainingNutrition;

    public function __construct()
    {
        $this->foods = new ArrayCollection();
        $this->trainingNutrition = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Nutrition
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Nutrition
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Nutrition
    {
        $this->description = $description;

        return $this;
    }

    public function getMill(): int
    {
        return $this->mill;
    }

    public function setMill(int $mill): Nutrition
    {
        $this->mill = $mill;

        return $this;
    }

    public function getCalories(): int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): Nutrition
    {
        $this->calories = $calories;

        return $this;
    }

    public function getProtein(): int
    {
        return $this->protein;
    }

    public function setProtein(int $protein): Nutrition
    {
        $this->protein = $protein;

        return $this;
    }

    public function getFoods(): Collection
    {
        return $this->foods;
    }

    public function setFoods(Collection $foods): Nutrition
    {
        $this->foods = $foods;

        return $this;
    }

    public function getTrainingNutrition(): Collection
    {
        return $this->trainingNutrition;
    }

    public function setTrainingNutrition(Collection $trainingNutrition): Nutrition
    {
        $this->trainingNutrition = $trainingNutrition;

        return $this;
    }

    public function getCreateAt(): DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(DateTimeInterface $createAt): Nutrition
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeInterface $updateAt): Nutrition
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getDeletedAt(): DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(DateTimeInterface $deletedAt): Nutrition
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
