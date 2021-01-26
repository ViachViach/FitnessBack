<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserTrainingRepository")
 * @ORM\Table(name="user_training", schema="public")
 */
class UserTraining
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\OneToOne(targetEntity="Training")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
    */
    private Training $training;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private User $user;

    /**
     * @ORM\Column(type="integer", name="week_day")
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
     * @return UserTraining
     */
    public function setId(int $id): UserTraining
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
     * @return UserTraining
     */
    public function setTraining(Training $training): UserTraining
    {
        $this->training = $training;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return UserTraining
     */
    public function setUser(User $user): UserTraining
    {
        $this->user = $user;
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
     * @return UserTraining
     */
    public function setWeekDay(int $weekDay): UserTraining
    {
        $this->weekDay = $weekDay;
        return $this;
    }
}
