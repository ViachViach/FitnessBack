<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\Response\CountryResponse;
use App\Entity\Country;

class CountryAdapter
{
    public function __construct(
        private Country $country
    ){ }

    public function createResponse(): CountryResponse
    {
        $result = new CountryResponse();
        $result
            ->setId($this->country->getId())
            ->setName($this->country->getName())
        ;

        $cities = [];
        foreach ($this->country->getCities() as $city) {
            $adapter  = new CityAdapter($city);
            $cities[] = $adapter->createResponse();
        }

        $result->setCities($cities);

        return $result;
    }
}
