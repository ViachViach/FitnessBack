<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FoodRepository")
 */
class Food
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="text")
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private int $count;

    /**
     * @ORM\ManyToOne(targetEntity="Nutrition", inversedBy="foods")
     */
    private Nutrition $nutrition;

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
     * @return Food
     */
    public function setId(int $id): Food
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
     * @return Food
     */
    public function setName(string $name): Food
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     *
     * @return Food
     */
    public function setCount(int $count): Food
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return Nutrition
     */
    public function getNutrition(): Nutrition
    {
        return $this->nutrition;
    }

    /**
     * @param Nutrition $nutrition
     *
     * @return Food
     */
    public function setNutrition(Nutrition $nutrition): Food
    {
        $this->nutrition = $nutrition;
        return $this;
    }
}
