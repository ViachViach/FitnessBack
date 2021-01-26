<?php

declare(strict_types=1);

namespace App\Controller;

use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\TrainingService;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security(name="Bearer")
 * @OA\Tag(name="Nutrition")
 * @Route("nutrition")
 */
class NutritionController
{
    private TrainingService $trainingService;

    private SerializerInterface $serializer;

    public function __construct(
        TrainingService $trainingService,
        SerializerInterface $serializer
    ) {
        $this->trainingService = $trainingService;
        $this->serializer = $serializer;
    }


    public function actionGetNutrition(Request $request): JsonResponse
    {
        return new JsonResponse();
    }

    public function actionCreateNutrition(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}
