<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\TrainingService;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @OA\Tag(name="Training")
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

    public function getTrainingsByCurrentUserId(): JsonResponse
    {
        $trainings = $this->trainingService->getTrainingsByCurrencyUser();
        $response = $this->serializer->serialize($trainings, JsonEncoder::FORMAT);

        return new JsonResponse($response);
    }
}
