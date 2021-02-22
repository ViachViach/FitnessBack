<?php

declare(strict_types=1);

namespace App\Tests\Unit\Controller;

use App\Controller\CountryController;
use App\DTO\Controller\Request\CreateCountryRequest;
use App\Service\CountryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class CountryControllerTest extends AbstractControllerTest
{

    private CountryController $controller;

    private CountryService $countryService;

    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        static::bootKernel();
        $container = static::$container;

        $this->countryService = $this->getMockBuilder(CountryService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->serializer = $container->get(SerializerInterface::class);

        $this->controller = new CountryController(
            $this->serializer,
            $this->countryService,
        );
    }

    /**
     * @dataProvider getAllCountry
     */
    public function testGetAll(array $country): void
    {
        $this->countryService
            ->expects($this->once())
            ->method('getAll')
            ->willReturn($country);

        $result = $this->controller->getAll();

        $data     = $this->serializer->serialize($country, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testGetById(): void
    {
        $id      = rand(0, 100);
        $country = $this->createCountry($id,'Russia');

        $this->countryService
            ->expects($this->once())
            ->method('getResponseById')
            ->with($id)
            ->willReturn($country);

        $result = $this->controller->getById($id);

        $data     = $this->serializer->serialize($country, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testCreate(): void
    {
        $id      = rand(1, 100);
        $name    = 'Russian';
        $country = sprintf('{"name":"%s", "id": %d}', $name, $id);

        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestMock
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($country);

        $createCityRequest = new CreateCountryRequest();
        $createCityRequest
            ->setName($name)
        ;

        $createCountryResponse = $this->createCountry($id, 'Russian');

        $this->countryService
            ->expects($this->once())
            ->method('create')
            ->willReturn($createCountryResponse);

        $result = $this->controller->create($requestMock);

        $data     = $this->serializer->serialize($createCountryResponse, JsonEncoder::FORMAT);
        $response = new JsonResponse($data, JsonResponse::HTTP_OK, [], true);

        $this->assertEquals($response, $result);
    }

    public function testUpdate(): void
    {
        $id      = rand(1, 1000);
        $name    = 'Russian';
        $country = sprintf('{"name":"%s", "id": %d}', $name, $id);

        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestMock
            ->expects($this->once())
            ->method('getContent')
            ->willReturn($country);

        $countryResponse = $this->createCountry($id, $name);

        $this->countryService
            ->expects($this->once())
            ->method('update')
            ->willReturn($countryResponse);

        $result = $this->controller->update($requestMock, $id);

        $data     = $this->serializer->serialize($countryResponse, JsonEncoder::FORMAT);
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

    public function getAllCountry(): array
    {
        $emptyCity = [];
        $resultOne = [$emptyCity];

        $countryOne = $this->createCountry(rand(1, 1000),'Russia');
        $resultTwo  = [$countryOne];

        $countryTwo  = $this->createCountry(rand(1, 1000),'Russia');
        $resultThree = [
            $countryTwo,
            $resultTwo,
        ];

        return [
            [$resultOne],
            [$resultTwo],
            [$resultThree],
        ];
    }

}
