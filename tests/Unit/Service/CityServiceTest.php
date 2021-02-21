<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Service\CityService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CityServiceTest extends KernelTestCase
{
    private CityService $cityService;

    protected function setUp(): void
    {
        static::bootKernel();
        $container = static::$container;

        $this->cityService = $container->get(CityService::class);
    }


    public function testCreate()
    {

        $this->assertEquals('asdsd', 'asdsd');
    }

    public function testUpdate()
    {

    }
}
