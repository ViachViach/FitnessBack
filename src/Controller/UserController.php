<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Controller\Response\UserResponse;
use App\Exception\UserNotFoundException;
use App\Service\UserService;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @OA\Tag(name="Users")
 */
class UserController
{
    public function __construct(
        private UserService $userService,
        private SerializerInterface $serializer
    ) { }

    /**
     *
     * @Route("/", name="user:get-currency-user", methods={"GET"})
     *
     * @OA\Get(
     *    description="Get currency user",
     *    summary="Return currency user",
     *    @OA\Response(
     *         response=200,
     *         description="Array of exercises",
     *         @OA\Response(
     *             response=200,
     *             description="exercise",
     *             @OA\JsonContent(
     *                 ref=@Model(type=UserResponse::class)
     *             )
     *         ),
     *    ),
     * )
     * @throws UserNotFoundException
     */
    public function actionGetCurrencyUser(): JsonResponse
    {
        $user     = $this->userService->getCurrencyUserResponse();
        $response = $this->serializer->serialize($user, JsonEncoder::FORMAT);

        return new JsonResponse($response, JsonResponse::HTTP_OK, [], true);
    }
}
