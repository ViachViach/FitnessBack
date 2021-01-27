<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\UserTraining;

class UserTrainingFixture extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $userTraining = new UserTraining();
            $userTraining
                ->setTraining($this->getReference("Training {$i}"))
                ->setUser($this->getReference(UserFixture::USER_LIST[rand(0, 1)]))
                ->setWeekDay(rand(1, 7))
            ;

            $manager->persist($userTraining);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            TrainingFixture::class,
            UserFixture::class
        ];
    }
}
