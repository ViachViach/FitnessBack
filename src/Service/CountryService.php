<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\CountryAdapter;
use App\DTO\Controller\Request\CreateCountryRequest;
use App\DTO\Controller\Response\CountryResponse;
use App\Entity\Country;
use App\Repository\CountryRepository;
use ViachViach\ExceptionHandler\Exception\NotFoundException;

class CountryService
{
    public function __construct(
        private CountryRepository $countryRepository
    ) { }

    public function create(CreateCountryRequest $createCityRequest): CountryResponse
    {
        $country = new Country();
        $country
            ->setName($createCityRequest->getName())
        ;

        $this->countryRepository->save($country);

        $adapter = new CountryAdapter($country);
        return $adapter->createResponse();
    }

    public function update(CreateCountryRequest $createCityRequest, int $id): CountryResponse
    {
        $country = $this->getById($id);
        $country
            ->setName($createCityRequest->getName())
        ;

        $this->countryRepository->save($country);

        $adapter = new CountryAdapter($country);
        return $adapter->createResponse();
    }

    public function getResponseById(int $id): CountryResponse
    {
        $country = $this->getById($id);

        $adapter = new CountryAdapter($country);
        return $adapter->createResponse();
    }

    /**
     * @var CountryResponse[]
    */
    public function getAll(): array
    {
        $countries = $this->countryRepository->findAll();

        $result = [];
        foreach ($countries as $country) {
            $adapter  = new CountryAdapter($country);
            $result[] = $adapter->createResponse();
        }

        return $result;
    }

    public function deleteById(int $id): void
    {
        $country = $this->getById($id);
    }

    /**
     * @throws  NotFoundException
    */
    public function getById(int $id): Country
    {
        $country = $this->countryRepository->find($id);

        if ($country === null) {
            throw new NotFoundException();
        }

        return $country;
    }
}
