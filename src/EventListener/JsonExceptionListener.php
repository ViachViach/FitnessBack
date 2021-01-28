<?php

declare(strict_types=1);

namespace App\EventListener;

use App\DTO\Exception\NotFoundException;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\SerializerInterface;

class JsonExceptionListener
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse();

        if ($exception instanceof EntityNotFoundException) {
            $response->setStatusCode(JsonResponse::HTTP_NOT_FOUND);

            $data = new NotFoundException();
            $data
                ->setMessage($exception->getMessage())
                ->setCode(JsonResponse::HTTP_NOT_FOUND)
            ;

            $response->setData($data);
        }


        $event->setResponse($response);
    }
}
