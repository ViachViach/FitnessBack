<?php

declare(strict_types=1);

namespace App\Tests\Unit\Controller;

use App\Controller\ExerciseController;
use App\Service\ExerciseService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ExerciseControllerTest extends AbstractControllerTest
{
    private ExerciseController $controller;

    private ExerciseService $exerciseService;

    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        static::bootKernel();
        $container = static::$container;

        $this->exerciseService = $this->getMockBuilder(ExerciseService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->serializer = $container->get(SerializerInterface::class);

        $this->controller = new ExerciseController(
            $this->serializer,
            $this->exerciseService,
        );
    }

    /**
     * @dataProvider getAllExercise
     */
    public function testGetAll(array $exercises): void
    {
        $this->exerciseService
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($exercises);

        $result = $this->controller->getAll();

        $data     = $this->serializer->serialize($exercises, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testGetById(): void
    {
        $id       = rand(0, 100);
        $exercise = $this->createExercise($id);

        $this->exerciseService
            ->expects($this->once())
            ->method('getResponseById')
            ->with($id)
            ->willReturn($exercise);

        $result = $this->controller->getById($id);

        $data     = $this->serializer->serialize($exercise, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testCreate(): void
    {
        $id           = rand(1, 100);
        $exercise     = $this->createExercise($id);
        $exerciseJson = sprintf(
            '{"name":"%s", "description": "%s"}',
            $exercise->getName(),
            $exercise->getDescription()
        );

        $requestMock = $this
            ->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $requestMock
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($exerciseJson)
        ;

        $createExerciseResponse = $this->createExercise($id);

        $this->exerciseService
            ->expects($this->once())
            ->method('create')
            ->willReturn($createExerciseResponse);

        $result = $this->controller->create($requestMock);

        $data     = $this->serializer->serialize($createExerciseResponse, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testUpdate(): void
    {
        $id           = rand(1, 100);
        $exercise     = $this->createExercise($id);
        $exerciseJson = sprintf(
            '{"name":"%s", "description": "%s"}',
            $exercise->getName(),
            $exercise->getDescription()
        );

        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestMock
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($exerciseJson);

        $this->exerciseService
            ->expects($this->once())
            ->method('update')
            ->willReturn($exercise);

        $result = $this->controller->update($requestMock, $id);

        $data     = $this->serializer->serialize($exercise, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testDelete(): void
    {
        $id       = rand(1, 1000);
        $result   = $this->controller->delete($id);
        $response = new JsonResponse(null, JsonResponse::HTTP_OK);

        $this->assertEquals($response, $result);
    }

    public function getAllExercise(): array
    {
        $emptyExercise = [];
        $resultOne     = [$emptyExercise];

        $exerciseOne = $this->createExercise(rand(1, 1000));
        $resultTwo   = [$exerciseOne];

        $exerciseTwo = $this->createExercise(rand(1, 1000));
        $resultThree = [
            $exerciseTwo,
            $resultTwo,
        ];

        return [
            [$resultOne],
            [$resultTwo],
            [$resultThree],
        ];
    }
}
