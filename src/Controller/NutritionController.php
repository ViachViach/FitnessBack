<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\NutritionService;
use Doctrine\ORM\EntityNotFoundException;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\TrainingService;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\DTO\Exception\UnauthorizedException;
use App\DTO\Exception\NotFoundException;
use App\DTO\Controller\NutritionResponse;

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
     * @param int $id
     * @return JsonResponse
     */
    public function get(int $id): JsonResponse
    {
        $nutrition = $this->nutritionService->getById($id);



        return new JsonResponse();
    }

    public function getAll(): JsonResponse
    {
        return new JsonResponse();
    }
}
