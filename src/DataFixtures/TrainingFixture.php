<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Exercise;
use App\Entity\Training;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrainingFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $exerciseIncrement = 30;

        for ($i = 0; $i < 20; $i++) {
            $training = new Training();
            $training->setName("Training {$i}");
            $training->setDescription("Some description about this training........");
            $rand = rand(3, 10);
            $exerciseIdAlreadySet = [];

            for ($te = 0; $te < $rand; $te++) {
                $newItem = $this->getUnsetExercise($exerciseIdAlreadySet, ($exerciseIncrement - 1));
                $exerciseIdAlreadySet[] = $newItem;
            }

            $this->addReference("Training {$i}", $training);
            $manager->persist($training);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            UserFixture::class
        ];
    }

    /**
     * @param int[] $setExerciseIds
     */
    private function getUnsetExercise(array $setExerciseIds, int $exerciseIncrement): int
    {
        $exerciseId = rand(0, $exerciseIncrement);

        while (in_array($exerciseId, $setExerciseIds, true)) {
            $exerciseId = rand(0, $exerciseIncrement);
        }

        return $exerciseId;
    }
}
