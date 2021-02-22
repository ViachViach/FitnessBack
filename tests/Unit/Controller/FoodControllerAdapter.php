<?php

declare(strict_types=1);

namespace App\Tests\Unit\Controller;

use App\Controller\FoodController;
use App\Service\FoodService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class FoodControllerAdapter extends AbstractControllerTest
{
    private FoodController $controller;

    private FoodService $foodService;

    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        static::bootKernel();
        $container = static::$container;

        $this->foodService = $this->getMockBuilder(FoodService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->serializer = $container->get(SerializerInterface::class);

        $this->controller = new FoodController(
            $this->serializer,
            $this->foodService,
        );
    }

    /**
     * @dataProvider getAllFood
     */
    public function testGetAll(array $foods): void
    {
        $this->foodService
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($foods);

        $result = $this->controller->getAll();

        $data     = $this->serializer->serialize($foods, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testGetById(): void
    {
        $id   = rand(0, 100);
        $food = $this->createFood($id);

        $this->foodService
            ->expects($this->once())
            ->method('getResponseById')
            ->with($id)
            ->willReturn($food);

        $result = $this->controller->getById($id);

        $data     = $this->serializer->serialize($food, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testCreate(): void
    {
        $id       = rand(1, 100);
        $food     = $this->createFood($id);
        $foodJson = sprintf(
            '{"name":"%s", "count": %d}',
            $food->getName(),
            $food->getCount()
        );

        $requestMock = $this
            ->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $requestMock
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($foodJson)
        ;

        $this->foodService
            ->expects($this->once())
            ->method('create')
            ->willReturn($food);

        $result = $this->controller->create($requestMock);

        $data     = $this->serializer->serialize($food, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testUpdate(): void
    {
        $id       = rand(1, 100);
        $food     = $this->createFood($id);
        $foodJson = sprintf(
            '{"name":"%s", "count": %d}',
            $food->getName(),
            $food->getCount()
        );

        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestMock
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($foodJson);

        $this->foodService
            ->expects($this->once())
            ->method('update')
            ->willReturn($food);

        $result = $this->controller->update($requestMock, $id);

        $data     = $this->serializer->serialize($food, JsonEncoder::FORMAT);
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

    public function getAllFood(): array
    {
        $empty     = [];
        $resultOne = [$empty];

        $oneCase   = $this->createFood(rand(1, 1000));
        $resultTwo = [$oneCase];

        $twoCase     = $this->createFood(rand(1, 1000));
        $resultThree = [
            $oneCase,
            $twoCase,
        ];

        return [
            [$resultOne],
            [$resultTwo],
            [$resultThree],
        ];
    }
}
