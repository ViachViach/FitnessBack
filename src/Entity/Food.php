<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FoodRepository")
 * @ORM\Table(name="food", schema="public")
 */
class Food
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
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
     * @ORM\ManyToOne(targetEntity="Nutrition")
     * @ORM\JoinColumn(name="nutrition_id", referencedColumnName="id")
     */
    private int $nutrition;

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
     * @return int
     */
    public function getNutrition(): int
    {
        return $this->nutrition;
    }

    /**
     * @param int $nutrition
     *
     * @return Food
     */
    public function setNutrition(int $nutrition): Food
    {
        $this->nutrition = $nutrition;
        return $this;
    }
}
