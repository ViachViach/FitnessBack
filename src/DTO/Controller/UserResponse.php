<?php

declare(strict_types=1);

namespace App\DTO\Controller;

final class UserResponse
{
    private string $firstName = '';

    private string $email;

    private string $password = '';

    private string $role;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return UserResponse
     */
    public function setFirstName(string $firstName): UserResponse
    {
        $this->firstName = $firstName;
        return $this;
    }

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
     * @return UserResponse
     */
    public function setEmail(string $email): UserResponse
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
     * @return UserResponse
     */
    public function setPassword(string $password): UserResponse
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     *
     * @return UserResponse
     */
    public function setRole(string $role): UserResponse
    {
        $this->role = $role;
        return $this;
    }
}
