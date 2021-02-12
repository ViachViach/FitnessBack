<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Exercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Exercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercise[]    findAll()
 * @method Exercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercise::class);
    }

    public function findById(int $id): ?Exercise
    {
        $qb = $this->createQueryBuilder('exercise');

        $query = $qb->select('exercise')
            ->where($qb->expr()->eq('exercise.id', ':id'))
            ->andWhere($qb->expr()->isNull('exercise.deletedAt'))
            ->setParameters(
                [':id' => $id]
            );

        return $query->getQuery()->getOneOrNullResult();
    }

    /**
     * @return Exercise[]
    */
    public function findAllExisting(): array
    {
        $qb = $this->createQueryBuilder('exercise');

        $query = $qb->select('exercise')
            ->where($qb->expr()->isNull('exercise.deletedAt'));

        return $query->getQuery()->getResult();
    }

    public function save(Exercise $exercise): void
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($exercise);
        $entityManager->flush();
    }
}
