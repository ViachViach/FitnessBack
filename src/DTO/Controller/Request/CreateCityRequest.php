<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Create city",
 *     description="Create city schema",
 *     required={"name", "countryId"}
 * )
 */
final class CreateCityRequest
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="City's name"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     nullable=true,
     *     description="Country id"
     * )
     */
    private int $countryId;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateCityRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): CreateCityRequest
    {
        $this->countryId = $countryId;
        return $this;
    }
}
