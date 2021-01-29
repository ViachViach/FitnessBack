<?php

declare(strict_types=1);

namespace App\DTO\Controller;

final class UserResponse
{
    private string $firstName = '';

    private string $email;

    private string $password = '';

    private string $role;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): UserResponse
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): UserResponse
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): UserResponse
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): UserResponse
    {
        $this->role = $role;

        return $this;
    }
}
