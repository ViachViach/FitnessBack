<?php

declare(strict_types=1);

namespace App\Tests\Unit\Controller;

use App\DTO\Controller\Response\CityResponse;
use App\DTO\Controller\Response\CountryResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class AbstractControllerTest extends KernelTestCase
{

    protected function createCountry(int $id, string $countryName): CountryResponse
    {
        $country = new CountryResponse();
        $country
            ->setId($id)
            ->setName($countryName)
        ;

        return $country;
    }

    protected function createCity(int $id, string $name, int $countryId): CityResponse
    {
        $city = new CityResponse();
        $city
            ->setId($id)
            ->setName($name)
            ->setCountryId($countryId)
        ;

        return $city;
    }
}
