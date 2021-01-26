<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NutritionRepository")
 * @ORM\Table(name="nutrition", schema="public")
 */
class Nutrition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
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
     * @ORM\OneToMany(targetEntity="Food", mappedBy="nutrition_id")
    */
    private array $foods;

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
     * @return array
     */
    public function getFoods(): array
    {
        return $this->foods;
    }

    /**
     * @param array $foods
     *
     * @return Nutrition
     */
    public function setFoods(array $foods): Nutrition
    {
        $this->foods = $foods;
        return $this;
    }
}
