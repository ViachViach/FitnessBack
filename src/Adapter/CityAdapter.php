<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\Response\CityResponse;
use App\Entity\City;

class CityAdapter
{
    public function __construct(
        private City $city
    ) { }

    public function createResponse(): CityResponse
    {
        $response = new CityResponse();
        $response
            ->setId($this->city->getId())
            ->setName($this->city->getName())
            ->setCountryId($this->city->getCountry()->getId())
        ;

        return $response;
    }
}
