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
use App\DTO\Controller\Request\CreateCountryRequest;
use App\DTO\Exception\ValidationException;
use App\DTO\Controller\Response\CountryResponse;

/**
 * @OA\Tag(name="Country")
 * @Route("country")
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
class CountryController
{
    /**
     * @Route("", name="country:create", methods={"POST"})
     * @OA\Post(
     *     description="Create country",
     *     summary="Create country",
     *     @OA\RequestBody(
     *          description="Country body",
     *          @OA\JsonContent(
     *             ref=@Model(type=CreateCountryRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of country",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=CountryResponse::class)
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
     * @Route("/{id}", name="country:update", methods={"PUT"}, requirements={"id" = "\d+"})
     *
     * @OA\Put(
     *     description="Update country by id",
     *     summary="Update country by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="country id",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="country",
     *         @OA\JsonContent(
     *             ref=@Model(type=CreateCountryRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of country",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=CountryResponse::class)
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
     * @Route("/{id}", name="country:get", methods={"GET"}, requirements={"id" = "\d+"})
     *
     * @OA\Get(
     *    description="Get country by id",
     *    summary="Return country by id",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        schema=@OA\Schema(
     *            type="integer",
     *        ),
     *        description="country id",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="country",
     *        @OA\JsonContent(
     *           ref=@Model(type=CountryResponse::class)
     *        )
     *     ),
     * )
     */
    public function getById(int $id): JsonResponse
    {
        return new JsonResponse();
    }

    /**
     * @Route("", name="country:get-all", methods={"GET"})
     *
     * @OA\Get(
     *    description="Get country",
     *    summary="Return country",
     *    @OA\Response(
     *         response=200,
     *         description="Array of country",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 ref=@Model(type=CountryResponse::class)
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
     * @Route("/{id}", name="country:delete", methods={"DELETE"}, requirements={"id" = "\d+"})
     *
     * @OA\Delete(
     *     description="Delete country by id",
     *     summary="Delete country by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="country id",
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
