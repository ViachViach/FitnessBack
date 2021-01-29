<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Controller\Registration;
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
    private RegistrationService $registrationService;

    private SerializerInterface $serializer;

    public function __construct(RegistrationService $registrationService, SerializerInterface $serializer)
    {
        $this->registrationService = $registrationService;
        $this->serializer = $serializer;
    }

    public function actionRegistration(Request $request): JsonResponse
    {
        $registrationDto = $this->serializer->deserialize(
            $request->getContent(),
            Registration::class,
            JsonEncoder::FORMAT,
        );
        assert($registrationDto instanceof Registration);

        $this->registrationService->registrationUser($registrationDto);

        return new JsonResponse();
    }
}
