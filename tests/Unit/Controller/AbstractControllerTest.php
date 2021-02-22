<?php

declare(strict_types=1);

namespace App\Tests\Unit\Controller;

use App\DTO\Controller\Response\CityResponse;
use App\DTO\Controller\Response\CountryResponse;
use App\DTO\Controller\Response\ExerciseResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use DateTimeImmutable;

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

    protected function createExercise(int $id): ExerciseResponse
    {
        $exercise = new ExerciseResponse();
        $exercise
            ->setId($id)
            ->setName($this->generateRandomString(rand(10, 20)))
            ->setDescription($this->generateRandomString(rand(100, 1000)))
            ->setUpdateAt(new DateTimeImmutable())
            ->setCreateAt(new DateTimeImmutable())
        ;

        return $exercise;
    }

    protected function generateRandomString(int $length=10): string
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, ($charactersLength - 1))];
        }

        return $randomString;
    }
}
