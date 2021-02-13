<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="User response",
 *     description="User response schema"
 * )
 */
final class UserResponse
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="User's first name"
     * )
     */
    private string $firstName;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="User's email"
     * )
     */
    private string $email;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="User's password"
     * )
     */
    private string $password;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="User's role"
     * )
     */
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
