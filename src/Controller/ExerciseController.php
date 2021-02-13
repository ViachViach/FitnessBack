<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Controller\Request\CreateExerciseRequest;
use App\DTO\Controller\Response\ExerciseResponse;
use App\DTO\Exception\NotFoundException;
use App\DTO\Exception\UnauthorizedException;
use App\DTO\Exception\ValidationException;
use App\Service\ExerciseService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @OA\Tag(name="Exercise")
 * @Route("exercise")
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
class ExerciseController
{
    public function __construct(
        private ExerciseService $exerciseService,
        private SerializerInterface $serializer
    ) { }

    /**
     * @Route("", name="exercise:create", methods={"POST"})
     * @OA\Post(
     *     description="Create exercise",
     *     summary="Create exercise",
     *     @OA\RequestBody(
     *          description="Exercise body",
     *          @OA\JsonContent(
     *             ref=@Model(type=CreateExerciseRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of exercises",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=ExerciseResponse::class)
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
        $createExercise = $this->serializer->deserialize(
            $request->getContent(),
            CreateExerciseRequest::class,
            JsonEncoder::FORMAT,
        );

        $exercise = $this->exerciseService->create($createExercise);
        $data     = $this->serializer->serialize($exercise, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route("/{id}", name="exercise:update", methods={"PUT"}, requirements={"id" = "\d+"})
     *
     * @OA\Put(
     *     description="Update exercise by id",
     *     summary="Update exercise by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="Exercise id",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Exercise exercise",
     *         @OA\JsonContent(
     *             ref=@Model(type=CreateExerciseRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of exercises",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=ExerciseResponse::class)
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
        $createExercise = $this->serializer->deserialize(
            $request->getContent(),
            CreateExerciseRequest::class,
            JsonEncoder::FORMAT,
        );

        $exercise = $this->exerciseService->update($createExercise, $id);
        $data     = $this->serializer->serialize($exercise, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route("", name="exercise:get-all", methods={"GET"})
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
        $exerciseResponse = $this->exerciseService->getAll();
        $data = $this->serializer->serialize($exerciseResponse, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     *
     * @Route("/{id}", name="exercise:get", methods={"GET"}, requirements={"id" = "\d+"})
     *
     * @OA\Get(
     *    description="Get exercise by id",
     *    summary="Return exercise by id",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        schema=@OA\Schema(
     *            type="integer",
     *        ),
     *        description="exercise id",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="exercise",
     *        @OA\JsonContent(
     *           ref=@Model(type=ExerciseResponse::class)
     *        )
     *     ),
     * )
     */
    public function getById(int $id): JsonResponse
    {
        $exerciseResponse = $this->exerciseService->getResponseById($id);
        $data = $this->serializer->serialize($exerciseResponse, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     * @Route("/{id}", name="exercise:delete", methods={"DELETE"}, requirements={"id" = "\d+"})
     *
     * @OA\Delete(
     *     description="Delete exercise by id",
     *     summary="Delete exercise by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="exercise id",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted"
     *     ),
     * )
     */
    public function delete(int $id): JsonResponse
    {
        $this->exerciseService->deleteById($id);

        return new JsonResponse(null, JsonResponse::HTTP_OK);
    }
}
