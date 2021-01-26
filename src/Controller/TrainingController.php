<?php

declare(strict_types=1);

namespace App\Controller;

use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\TrainingService;

/**
 * @Security(name="Bearer")
 */
class TrainingController
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

    public function actionGetTrainings(Request $request): JsonResponse
    {
        $trainings = $this->trainingService->getTrainingsByCurrencyUser();
        $response = $this->serializer->serialize($trainings, JsonEncoder::FORMAT);

        return new JsonResponse($response);
    }
}
