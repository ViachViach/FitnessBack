<?php

declare(strict_types=1);

namespace App\Tests\Unit\Controller;

use App\Controller\CityController;
use App\DTO\Controller\Request\CreateCityRequest;
use App\DTO\Controller\Response\CityResponse;
use App\DTO\Controller\Response\CountryResponse;
use App\Service\CityService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class CityControllerTest extends AbstractControllerTest
{
    private CityController $controller;

    private CityService $cityService;

    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        static::bootKernel();
        $container = static::$container;

        $this->cityService = $this->getMockBuilder(CityService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->serializer = $container->get(SerializerInterface::class);

        $this->controller = new CityController(
            $this->serializer,
            $this->cityService,
        );
    }

    /**
     * @dataProvider getAllCities
     */
    public function testGetAll(array $cities): void
    {
        $this->cityService
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($cities);

        $result = $this->controller->getAll();

        $data     = $this->serializer->serialize($cities, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testGetById(): void
    {
        $id      = rand(0, 100);
        $country = $this->createCountry(rand(0, 100), 'Russia');
        $city    = $this->createCity($id, 'Moscow', $country->getId());

        $this->cityService
            ->expects($this->once())
            ->method('getResponseById')
            ->with($id)
            ->willReturn($city);

        $result = $this->controller->getById($id);

        $data     = $this->serializer->serialize($city, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testCreate(): void
    {
        $countryId = rand(1, 100);
        $country   = sprintf('{"name":"Moscow", "countryId": %d}', $countryId);

        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestMock
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($country);

        $createCityRequest = new CreateCityRequest();
        $createCityRequest
            ->setName('Moscow')
            ->setCountryId($countryId)
        ;

        $createCityResponse = $this->createCity(rand(0, 100), $createCityRequest->getName(), $countryId);

        $this->cityService
            ->expects($this->once())
            ->method('create')
            ->willReturn($createCityResponse);

        $result = $this->controller->create($requestMock);

        $data     = $this->serializer->serialize($createCityResponse, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testUpdate(): void
    {
        $id        = rand(1, 100);
        $countryId = rand(1, 100);
        $country   = sprintf('{"name":"Moscow", "countryId": %d}', $countryId);

        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestMock
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($country);

        $createCityRequest = new CreateCityRequest();
        $createCityRequest
            ->setName('Moscow')
            ->setCountryId($countryId)
        ;

        $createCityResponse = $this->createCity(rand(0, 100), $createCityRequest->getName(), $countryId);

        $this->cityService
            ->expects($this->once())
            ->method('update')
            ->willReturn($createCityResponse);

        $result = $this->controller->update($requestMock, $id);

        $data     = $this->serializer->serialize($createCityResponse, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function getAllCities(): array
    {
        $emptyCity = [];
        $resultOne = [$emptyCity];

        $country = $this->createCountry(rand(0, 100), 'Russia');

        $cityOne   = $this->createCity(rand(0, 100), 'Moscow', $country->getId());
        $resultTwo = [$cityOne];

        $cityTwo     = $this->createCity(rand(0, 100), 'St. Petersburg', $country->getId());
        $resultThree = [
            $cityOne,
            $cityTwo,
        ];

        return [
            [$resultOne],
            [$resultTwo],
            [$resultThree],
        ];
    }
}
