<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

use App\DTO\Controller\Response\ExerciseResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Registration",
 *     description="Registration schema",
 *     required={"email", "password"}
 * )
 */
final class Registration
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="eamil"
     * )
     */
    private string $email;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="password"
     * )
     */
    private string $password;

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
}
