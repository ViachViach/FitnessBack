<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Nutrition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nutrition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nutrition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nutrition[]    findAll()
 * @method Nutrition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NutritionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nutrition::class);
    }

    public function findById(int $id): ?Nutrition
    {
        $qb = $this->createQueryBuilder('nutrition');

        $query = $qb->select('nutrition')
            ->where($qb->expr()->eq('nutrition.id', ':id'))
            ->andWhere($qb->expr()->isNull('nutrition.deletedAt'))
            ->setParameters(
                [':id' => $id]
            );

        return $query->getQuery()->getOneOrNullResult();
    }

    /**
     * @return Nutrition[]
     */
    public function findAllExisting(): array
    {
        $qb = $this->createQueryBuilder('nutrition');

        $query = $qb->select('nutrition')
            ->where($qb->expr()->isNull('nutrition.deletedAt'));

        return $query->getQuery()->getResult();
    }

    public function save(Nutrition $nutrition): void
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($nutrition);
        $entityManager->flush();

    }
}
