<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Exception\NotFoundException;
use App\DTO\Exception\UnauthorizedException;
use App\Service\CityService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\DTO\Controller\Request\CreateCityRequest;
use App\DTO\Controller\Response\CityResponse;
use App\DTO\Exception\ValidationException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

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
    public function __construct(
        private SerializerInterface $serializer,
        private CityService $cityService,
    ) { }

    /**
     * @Route("", name="city:create", methods={"POST"})
     * @OA\Post(
     *     description="Create city",
     *     summary="Create city",
     *     @OA\RequestBody(
     *          description="City body",
     *          @OA\JsonContent(
     *             ref=@Model(type=CreateCityRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=CityResponse::class)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Validation city",
     *          @OA\JsonContent(
     *              ref=@Model(type=ValidationException::class),
     *          ),
     *     ),
     * )
     */
    public function create(Request $request): JsonResponse
    {
        $createCity = $this->serializer->deserialize(
            $request->getContent(),
            CreateCityRequest::class,
            JsonEncoder::FORMAT,
        );

        $city = $this->cityService->create($createCity);
        $data = $this->serializer->serialize($city, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }


    /**
     * @Route("/{id}", name="city:update", methods={"PUT"}, requirements={"id" = "\d+"})
     *
     * @OA\Put(
     *     description="Update city by id",
     *     summary="Update city by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema=@OA\Schema(type="integer"),
     *         description="City id",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref=@Model(type=CreateCityRequest::class)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Array of city",
     *         @OA\JsonContent(
     *             @OA\Items(
     *                 ref=@Model(type=CityResponse::class)
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
        $updateCity = $this->serializer->deserialize(
            $request->getContent(),
            CreateCityRequest::class,
            JsonEncoder::FORMAT,
        );

        $city = $this->cityService->update($updateCity, $id);
        $data = $this->serializer->serialize($city, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
    }

    /**
     *
     * @Route("/{id}", name="city:get", methods={"GET"}, requirements={"id" = "\d+"})
     *
     * @OA\Get(
     *    description="Get city by id",
     *    summary="Return city by id",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        schema=@OA\Schema(
     *            type="integer",
     *        ),
     *        description="city id",
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="city",
     *        @OA\JsonContent(
     *           ref=@Model(type=CityResponse::class)
     *        )
     *     ),
     * )
     */
    public function getById(int $id): JsonResponse
    {
        $city = $this->cityService->getResponseById($id);
        $data = $this->serializer->serialize($city, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_OK, [], true);
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
