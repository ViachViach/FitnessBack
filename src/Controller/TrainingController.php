<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Controller\Request\CreateExerciseRequest;
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
 * @Route("ttaining")
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
     * @Route("", name="training:create", methods={"POST"})
     * @OA\Post(
     *     description="Create training",
     *     summary="Create training",
     *     @OA\RequestBody(
     *          description="training body",
     *          @OA\JsonContent(
     *             ref=@Model(type=CreateTrainingRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of trainings",
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
        $createTraining = $this->serializer->deserialize(
            $request->getContent(),
            CreateExerciseRequest::class,
            JsonEncoder::FORMAT,
        );


        $training = $this->trainingService->crete($createTraining);
        $data     = $this->serializer->serialize($training, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route("/{id}", name="training:update", methods={"PUT"}, requirements={"id" = "\d+"})
     *
     * @OA\Put(
     *     description="Update training by id",
     *     summary="Update training by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="training id",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="training",
     *         @OA\JsonContent(
     *             ref=@Model(type=CreateTrainingRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of training",
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
        $createTraining = $this->serializer->deserialize(
            $request->getContent(),
            CreateExerciseRequest::class,
            JsonEncoder::FORMAT,
        );


        $training = $this->trainingService->update($createTraining, $id);
        $data     = $this->serializer->serialize($training, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     *
     * @Route("/{id}", name="training:get", methods={"GET"}, requirements={"id" = "\d+"})
     *
     * @OA\Get(
     *    description="Get training by id",
     *    summary="Return training by id",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        schema=@OA\Schema(
     *            type="integer",
     *        ),
     *        description="training id",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="training",
     *        @OA\JsonContent(
     *           ref=@Model(type=TrainingResponse::class)
     *        )
     *     ),
     * )
     */
    public function getById(int $id): JsonResponse
    {
        $exercise = $this->trainingService->getResponseById($id);
        $data     = $this->serializer->serialize($exercise, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route("", name="training:get-all", methods={"GET"})
     *
     * @OA\Get(
     *    description="Get training",
     *    summary="Return training",
     *    @OA\Response(
     *         response=200,
     *         description="Array of training",
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
        $trainings = $this->trainingService->getAll();
        $data      = $this->serializer->serialize($trainings, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route("/{id}", name="training:delete", methods={"DELETE"}, requirements={"id" = "\d+"})
     *
     * @OA\Delete(
     *     description="Delete training by id",
     *     summary="Delete training by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="training id",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted"
     *     ),
     * )
     */
    public function delete(int $id): JsonResponse
    {
        $this->trainingService->delete($id);

        return new JsonResponse(null, JsonResponse::HTTP_OK);
    }

    public function getTrainingsByCurrentUserId(): JsonResponse
    {
        $trainings = $this->trainingService->getTrainingsByCurrencyUser();
        $response  = $this->serializer->serialize($trainings, JsonEncoder::FORMAT);

        return new JsonResponse($response);
    }
}
