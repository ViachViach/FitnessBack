<?php

declare(strict_types=1);

namespace App\Entity;

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
     * @return Nutrition
     */
    public function setId(int $id): Nutrition
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
     * @return Nutrition
     */
    public function setName(string $name): Nutrition
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
     * @return Nutrition
     */
    public function setDescription(string $description): Nutrition
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getMill(): int
    {
        return $this->mill;
    }

    /**
     * @param int $mill
     *
     * @return Nutrition
     */
    public function setMill(int $mill): Nutrition
    {
        $this->mill = $mill;
        return $this;
    }

    /**
     * @return int
     */
    public function getCalories(): int
    {
        return $this->calories;
    }

    /**
     * @param int $calories
     *
     * @return Nutrition
     */
    public function setCalories(int $calories): Nutrition
    {
        $this->calories = $calories;
        return $this;
    }

    /**
     * @return int
     */
    public function getProtein(): int
    {
        return $this->protein;
    }

    /**
     * @param int $protein
     *
     * @return Nutrition
     */
    public function setProtein(int $protein): Nutrition
    {
        $this->protein = $protein;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getFoods(): Collection
    {
        return $this->foods;
    }

    /**
     * @param Collection $foods
     *
     * @return Nutrition
     */
    public function setFoods(Collection $foods): Nutrition
    {
        $this->foods = $foods;
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
     * @return Nutrition
     */
    public function setTrainingNutrition(Collection $trainingNutrition): Nutrition
    {
        $this->trainingNutrition = $trainingNutrition;
        return $this;
    }
}
