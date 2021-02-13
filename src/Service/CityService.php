<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\CityAdapter;
use App\DTO\Controller\Request\CreateCityRequest;
use App\DTO\Controller\Response\CityResponse;
use App\Entity\City;
use App\Repository\CityRepository;

class CityService
{
    public function __construct(
        private CityRepository $cityRepository,
        private CountryService $countryService,
    ) { }

    public function create(CreateCityRequest $createCityRequest): CityResponse
    {
        $country = $this->countryService->getById($createCityRequest->getCountryId());

        $city = new City();
        $city
            ->setName($createCityRequest->getName())
            ->setCountry($country)
        ;

        $this->cityRepository->save($city);

        $adapter = new CityAdapter($city);
        return $adapter->createResponse();
    }

    public function update(CreateCityRequest $createCityRequest, int $id): CityResponse
    {
        $country = $this->countryService->getById($createCityRequest->getCountryId());

        $city = $this->getById($id);
        $city
            ->setName($createCityRequest->getName())
            ->setCountry($country)
        ;

        $this->cityRepository->save($city);

        $adapter = new CityAdapter($city);
        return $adapter->createResponse();
    }

    public function getResponseById(int $id): CityResponse
    {

    }

    public function getAll(): array
    {

    }

    public function deleteById(int $id): void
    {

    }

    public function getById(int $id): City
    {

    }
}
