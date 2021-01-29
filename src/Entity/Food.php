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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Food
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Food
    {
        $this->name = $name;

        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): Food
    {
        $this->count = $count;

        return $this;
    }

    public function getNutrition(): Nutrition
    {
        return $this->nutrition;
    }

    public function setNutrition(Nutrition $nutrition): Food
    {
        $this->nutrition = $nutrition;

        return $this;
    }
}
