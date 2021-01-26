<?php

declare(strict_types=1);

namespace App\DTO\Controller;

final class Registration
{
    private string $email;

    private string $password;

    private ExerciseResponse $exercises;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Registration
     */
    public function setEmail(string $email): Registration
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return Registration
     */
    public function setPassword(string $password): Registration
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return ExerciseResponse
     */
    public function getExercises(): ExerciseResponse
    {
        return $this->exercises;
    }

    /**
     * @param ExerciseResponse $exercises
     *
     * @return Registration
     */
    public function setExercises(ExerciseResponse $exercises): Registration
    {
        $this->exercises = $exercises;
        return $this;
    }
}
