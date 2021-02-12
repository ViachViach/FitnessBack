<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Exception\NotFoundException;
use App\DTO\Exception\UnauthorizedException;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @OA\Tag(name="City")
 * @Route("nutrition")
 * @OA\Response(
 *     response="401",
 *     description="Unauthorized",
 *     @OA\JsonContent(
 *         ref=@Model(type=UnauthorizedException::class),
 *     ),
 * )
 * @OA\Response(
 *     response="404",
 *     description="Unauthorized",
 *     @OA\JsonContent(
 *         ref=@Model(type=NotFoundException::class),
 *     ),
 * )
 */
class CityController
{
    public function create(Request $request): JsonResponse
    {
        return new JsonResponse();
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return new JsonResponse();
    }

    public function getById(int $id): JsonResponse
    {
        return new JsonResponse();
    }

    public function getAll(): JsonResponse
    {
        return new JsonResponse();
    }

    public function delete(int $id): JsonResponse
    {
        return new JsonResponse();
    }
}
