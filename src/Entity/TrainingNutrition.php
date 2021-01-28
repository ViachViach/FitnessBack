<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="training_nutrition", schema="public")
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
     * @ORM\OneToOne(targetEntity="Training")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     */
    private Training $training;

    /**
     * @ORM\OneToOne(targetEntity="Nutrition")
     * @ORM\JoinColumn(name="nutrition_id", referencedColumnName="id")
     */
    private Nutrition $nutrition;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $weekDay;

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
     * @return TrainingNutrition
     */
    public function setId(int $id): TrainingNutrition
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Training
     */
    public function getTraining(): Training
    {
        return $this->training;
    }

    /**
     * @param Training $training
     *
     * @return TrainingNutrition
     */
    public function setTraining(Training $training): TrainingNutrition
    {
        $this->training = $training;
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
     * @return TrainingNutrition
     */
    public function setNutrition(Nutrition $nutrition): TrainingNutrition
    {
        $this->nutrition = $nutrition;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeekDay(): int
    {
        return $this->weekDay;
    }

    /**
     * @param int $weekDay
     *
     * @return TrainingNutrition
     */
    public function setWeekDay(int $weekDay): TrainingNutrition
    {
        $this->weekDay = $weekDay;
        return $this;
    }
}
