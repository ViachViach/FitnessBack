<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Controller\Response\NutritionResponse;
use App\DTO\Exception\NotFoundException;
use App\DTO\Exception\UnauthorizedException;
use App\Service\NutritionService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use App\DTO\Exception\ValidationException;
use App\DTO\Controller\Request\CreateNutritionRequest;

/**
 * @OA\Tag(name="Nutrition")
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
class NutritionController
{
    private NutritionService $nutritionService;

    private SerializerInterface $serializer;

    public function __construct(
        NutritionService $nutritionService,
        SerializerInterface $serializer
    ) {
        $this->nutritionService = $nutritionService;
        $this->serializer = $serializer;
    }

    /**
     *
     * @Route("/{id}", name="nutrition:get", methods={"GET"}, requirements={"id" = "\d+"})
     *
     * @OA\Get(
     *    description="Get nutrition by id",
     *    summary="Return nutrition by id",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        schema=@OA\Schema(
     *            type="integer",
     *        ),
     *        description="nutrition id",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="nutrition",
     *        @OA\JsonContent(
     *           ref=@Model(type=NutritionResponse::class)
     *        )
     *     ),
     * )
     */
    public function get(int $id): JsonResponse
    {
        $nutrition = $this->nutritionService->getById($id);
        $data = $this->serializer->serialize($nutrition, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     *
     * @Route("", name="nutrition:get-all", methods={"GET"})
     *
     * @OA\Get(
     *    description="Get nutrition",
     *    summary="Return nutrition",
     *    @OA\Response(
     *         response=200,
     *         description="Array of nutrition",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 ref=@Model(type=NutritionResponse::class)
     *             )
     *         )
     *    ),
     * )
     */
    public function getAll(): JsonResponse
    {
        $nutrition = $this->nutritionService->getAll();
        $data = $this->serializer->serialize($nutrition, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route("/{id}", name="nutrition:delete", methods={"DELETE"}, requirements={"id" = "\d+"})
     *
     * @OA\Delete(
     *     description="Delete nutrition by id",
     *     summary="Delete nutrition by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="nutrition id",
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

    /**
     * @Route("", name="nutrition:create", methods={"POST"})
     * @OA\Post(
     *     description="Create nutrition",
     *     summary="Create nutrition",
     *     @OA\RequestBody(
     *          description="New nutrition body",
     *          @OA\JsonContent(
     *             ref=@Model(type=CreateNutritionRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of nutrition",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=NutritionResponse::class)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Validation nutrition",
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
     * @Route("/{id}", name="nutrition:update", methods={"PUT"}, requirements={"id" = "\d+"})
     *
     * @OA\Put(
     *     description="Update nutrition by id",
     *     summary="Update nutrition by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="Nutrition id",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Nutrition",
     *         @OA\JsonContent(
     *             ref=@Model(type=CreateNutritionRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of nutrition",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=NutritionResponse::class)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Validation nutrition",
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
}
