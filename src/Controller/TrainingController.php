<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\TrainingService;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\DTO\Exception\UnauthorizedException;
use App\DTO\Exception\NotFoundException;
use App\DTO\Controller\Request\CreateTrainingRequest;
use App\DTO\Controller\Response\TrainingResponse;
use App\DTO\Exception\ValidationException;

/**
 * @OA\Tag(name="Training")
 * @Route("Ttaining")
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
class TrainingController
{
    public function __construct(
        private TrainingService $trainingService,
        private SerializerInterface $serializer
    ) { }

    /**
     * @Route("", name="food:create", methods={"POST"})
     * @OA\Post(
     *     description="Create food",
     *     summary="Create food",
     *     @OA\RequestBody(
     *          description="food body",
     *          @OA\JsonContent(
     *             ref=@Model(type=CreateTrainingRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of food",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=TrainingResponse::class)
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
     *             ref=@Model(type=CreateTrainingRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of food",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=TrainingResponse::class)
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
     *           ref=@Model(type=TrainingResponse::class)
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
     *                 ref=@Model(type=TrainingResponse::class)
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

    public function getTrainingsByCurrentUserId(): JsonResponse
    {
        $trainings = $this->trainingService->getTrainingsByCurrencyUser();
        $response  = $this->serializer->serialize($trainings, JsonEncoder::FORMAT);

        return new JsonResponse($response);
    }
}
