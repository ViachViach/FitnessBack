<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Training;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Training|null find($id, $lockMode = null, $lockVersion = null)
 * @method Training|null findOneBy(array $criteria, array $orderBy = null)
 * @method Training[]    findAll()
 * @method Training[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Training::class);
    }

    /**
     *
     * @return Training[]
     */
    public function findByUserId(int $userId): array
    {
        $qb = $this->createQueryBuilder('training');

        $query = $qb->select('training')
            ->leftJoin('training.user', 'u')
            ->where($qb->expr()->eq('u.id', ':userId'))
            ->setParameters(
                [
                    ':userId',
                    $userId,
                ]
            );

        return $query->getQuery()->execute();
    }

    public function save(Training $training): void
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($training);
        $entityManager->flush();
    }
}
