<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Create country",
 *     description="Create country schema",
 *     required={"name"}
 * )
 */
final class CreateCountryRequest
{
    /**
     * @OA\Property(
     *     nullable=false,
     *     description="Country's name"
     * )
     */
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateCountryRequest
    {
        $this->name = $name;
        return $this;
    }
}
