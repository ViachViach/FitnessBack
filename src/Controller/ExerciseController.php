<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Controller\CreateExercise;
use App\Service\ExerciseService;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\DTO\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\DTO\Exception\ValidationException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use App\DTO\Exception\UnauthorizedException;
use App\DTO\Controller\ExerciseResponse;

/**
 * @Security(name="Bearer")
 * @OA\Tag(name="Admin Exercise")
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
    private ExerciseService $exerciseService;

    private SerializerInterface $serializer;

    private UrlGeneratorInterface $urlGenerator;

    /**
     * @param ExerciseService     $exerciseService
     * @param SerializerInterface $serializer
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        ExerciseService $exerciseService,
        SerializerInterface $serializer,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->exerciseService = $exerciseService;
        $this->serializer = $serializer;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * @Route("", name="exercise:create", methods={"POST"})
     * @OA\Post(
     *     description="Create exercise",
     *     summary="Create exercise",
     *     @OA\RequestBody(
     *          description="New exercise body",
     *          @OA\JsonContent(
     *             ref=@Model(type=CreateExercise::class)
     *         )
     *     ),
     *     @OA\Response(
     *          response="201",
     *          description="exercise created",
     *          @OA\Header(
     *              header="Location",
     *              @OA\Schema(type="string"),
     *                  description="Location for new entity /exercise/{id}"
     *          ),
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Validation exceptions",
     *          @OA\JsonContent(
     *              ref=@Model(type=ValidationException::class),
     *          ),
     *     ),
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        /**@var CreateExercise $exerciseDto*/
        $createExercise = $this->serializer->deserialize(
            $request->getContent(),
            CreateExercise::class,
            JsonEncoder::FORMAT
        );

        $this->exerciseService->create($createExercise);

        return new JsonResponse();
    }

    /**
     * @Route("/{id}", name="exercise:edit", methods={"PUT"}, requirements={"id" = "\d+"})
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
     *             ref=@Model(type=CreateExercise::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Exercise",
     *         @OA\Header(
     *             header="Location",
     *             @OA\Schema(type="string"),
     *                 description="Location for new entity /exercise/{id}"
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
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return new JsonResponse(
            null,
            JsonResponse::HTTP_OK,
            ['Location' => $this->urlGenerator->generate('exercise:get', ['id' => 1]),],
        );
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
     * @return JsonResponse
     */
    public function get(): JsonResponse
    {
        $exerciseDto = $this->exerciseService->getAll();
        $json = $this->serializer->serialize($exerciseDto, JsonEncoder::FORMAT);

        return new JsonResponse($json);
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
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $id): JsonResponse
    {
        $exerciseDto = $this->exerciseService->getResponseById($id);
        $json = $this->serializer->serialize($exerciseDto, JsonEncoder::FORMAT);

        return new JsonResponse($json);
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
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        return new JsonResponse(null, JsonResponse::HTTP_OK);
    }
}
