<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Controller\NutritionResponse;
use App\DTO\Exception\NotFoundException;
use App\DTO\Exception\UnauthorizedException;
use App\Service\NutritionService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Security(name="Bearer")
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
     * @Route("/", name="exercise:get-all", methods={"GET"})
     *
     * @OA\Get(
     *    description="Get exercises",
     *    summary="Return exercises",
     *    @OA\Response(
     *         response=200,
     *         description="Array of exercises",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 ref=@Model(type=ExerciseResponse::class)
     *             )
     *         )
     *    ),
     * )
     */
    public function getAll(): JsonResponse
    {
        return new JsonResponse();
    }
}
