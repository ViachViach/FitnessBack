<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Exercise;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;

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

    /**
     * @param int $id
     *
     * @return Exercise
     */
    public function findById(int $id): Exercise
    {
        $exercise = $this->find($id);
        if ($exercise === null) {
            throw new InvalidArgumentException(sprintf('Exercise with %b not found', $id));
        }

        return $exercise;
    }
}
