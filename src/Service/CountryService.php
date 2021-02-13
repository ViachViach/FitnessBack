<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Controller\Request\CreateCityRequest;
use App\DTO\Controller\Response\CityResponse;
use App\Entity\City;
use App\Entity\Country;
use App\Repository\CountryRepository;
use ViachViach\ExceptionHandler\Exception\NotFoundException;

class CountryService
{
    public function __construct(
        private CountryRepository $countryRepository
    ) { }

    public function create(CreateCityRequest $createCityRequest): CityResponse
    {

    }

    public function update(CreateCityRequest $createCityRequest, int $id): CityResponse
    {

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
