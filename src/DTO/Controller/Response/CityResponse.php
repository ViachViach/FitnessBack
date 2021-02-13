<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="City response",
 *     description="City response schema"
 * )
 */
final class CityResponse
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="City's id"
     * )
     */
    private int $id;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="City's name"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="City's country id"
     * )
     */
    private int $countryId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CityResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CityResponse
    {
        $this->name = $name;
        return $this;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): CityResponse
    {
        $this->countryId = $countryId;
        return $this;
    }
}
