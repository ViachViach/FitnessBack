<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrainingNutritionRepository")
 */
class TrainingNutrition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToone(targetEntity="Training", inversedBy="traningNutrition")
     */
    private Training $training;

    /**
     * @ORM\ManyToone(targetEntity="Nutrition", inversedBy="trainingNutrition")
     */
    private Nutrition $nutrition;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $weekDay;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): TrainingNutrition
    {
        $this->id = $id;

        return $this;
    }

    public function getTraining(): Training
    {
        return $this->training;
    }

    public function setTraining(Training $training): TrainingNutrition
    {
        $this->training = $training;

        return $this;
    }

    public function getNutrition(): Nutrition
    {
        return $this->nutrition;
    }

    public function setNutrition(Nutrition $nutrition): TrainingNutrition
    {
        $this->nutrition = $nutrition;

        return $this;
    }

    public function getWeekDay(): int
    {
        return $this->weekDay;
    }

    public function setWeekDay(int $weekDay): TrainingNutrition
    {
        $this->weekDay = $weekDay;

        return $this;
    }
}
