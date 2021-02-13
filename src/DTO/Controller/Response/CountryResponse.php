<?php

declare(strict_types=1);

namespace App\DTO\Controller\Response;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Country response",
 *     description="Country response schema"
 * )
 */
final class CountryResponse
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Country's id"
     * )
     */
    private int $id;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Country's name"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Cities"
     * )
     * @var CityResponse[]
    */
    private array $cities;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CountryResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CountryResponse
    {
        $this->name = $name;
        return $this;
    }

    public function getCities(): array
    {
        return $this->cities;
    }

    public function setCities(array $cities): CountryResponse
    {
        $this->cities = $cities;
        return $this;
    }
}
