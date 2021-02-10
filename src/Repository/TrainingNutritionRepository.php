<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\TrainingNutrition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrainingNutrition|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingNutrition|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingNutrition[]    findAll()
 * @method TrainingNutrition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingNutritionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingNutrition::class);
    }
}
