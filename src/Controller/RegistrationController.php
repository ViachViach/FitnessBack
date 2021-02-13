<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Controller\Request\Registration;
use App\Service\RegistrationService;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

use function assert;

/**
 * @OA\Tag(name="Registration")
 */
class RegistrationController
{
    public function __construct(
        private RegistrationService $registrationService,
        private SerializerInterface $serializer
    ) { }

    public function actionRegistration(Request $request): JsonResponse
    {
        $registrationRequest = $this->serializer->deserialize(
            $request->getContent(),
            Registration::class,
            JsonEncoder::FORMAT,
        );
        assert($registrationRequest instanceof Registration);

        $this->registrationService->registrationUser($registrationRequest);

        return new JsonResponse();
    }
}
