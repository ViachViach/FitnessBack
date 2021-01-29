<?php

declare(strict_types=1);

namespace App\DTO\Controller;

final class Registration
{
    private string $email;

    private string $password;

    private ExerciseResponse $exercises;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Registration
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): Registration
    {
        $this->password = $password;

        return $this;
    }

    public function getExercises(): ExerciseResponse
    {
        return $this->exercises;
    }

    public function setExercises(ExerciseResponse $exercises): Registration
    {
        $this->exercises = $exercises;

        return $this;
    }
}
