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
use App\DTO\Exception\ValidationException;
use App\DTO\Controller\Request\CreateFoodRequest;
use App\DTO\Controller\Response\FoodResponse;

/**
 * @OA\Tag(name="Food")
 * @Route("food")
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
class FoodController
{
    /**
     * @Route("", name="food:create", methods={"POST"})
     * @OA\Post(
     *     description="Create food",
     *     summary="Create food",
     *     @OA\RequestBody(
     *          description="food body",
     *          @OA\JsonContent(
     *             ref=@Model(type=CreateFoodRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of food",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=FoodResponse::class)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Validation exceptions",
     *          @OA\JsonContent(
     *              ref=@Model(type=ValidationException::class),
     *          ),
     *     ),
     * )
     */
    public function create(Request $request): JsonResponse
    {
        return new JsonResponse();
    }

    /**
     * @Route("/{id}", name="food:update", methods={"PUT"}, requirements={"id" = "\d+"})
     *
     * @OA\Put(
     *     description="Update food by id",
     *     summary="Update food by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="food id",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="food",
     *         @OA\JsonContent(
     *             ref=@Model(type=CreateFoodRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of food",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=FoodResponse::class)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Validation exceptions",
     *          @OA\JsonContent(
     *              ref=@Model(type=ValidationException::class),
     *          ),
     *     ),
     * )
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return new JsonResponse();
    }

    /**
     *
     * @Route("/{id}", name="food:get", methods={"GET"}, requirements={"id" = "\d+"})
     *
     * @OA\Get(
     *    description="Get food by id",
     *    summary="Return food by id",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        schema=@OA\Schema(
     *            type="integer",
     *        ),
     *        description="food id",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="food",
     *        @OA\JsonContent(
     *           ref=@Model(type=FoodResponse::class)
     *        )
     *     ),
     * )
     */
    public function getById(int $id): JsonResponse
    {
        return new JsonResponse();
    }

    /**
     * @Route("", name="food:get-all", methods={"GET"})
     *
     * @OA\Get(
     *    description="Get food",
     *    summary="Return food",
     *    @OA\Response(
     *         response=200,
     *         description="Array of food",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 ref=@Model(type=FoodResponse::class)
     *             )
     *         )
     *    ),
     * )
     */
    public function getAll(): JsonResponse
    {
        return new JsonResponse();
    }

    /**
     * @Route("/{id}", name="food:delete", methods={"DELETE"}, requirements={"id" = "\d+"})
     *
     * @OA\Delete(
     *     description="Delete food by id",
     *     summary="Delete food by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="food id",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted"
     *     ),
     * )
     */
    public function delete(int $id): JsonResponse
    {
        return new JsonResponse();
    }
}
