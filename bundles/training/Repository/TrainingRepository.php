<?php

declare(strict_types=1);

namespace Training\Bundle\TrainingBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Training\Bundle\TrainingBundle\Entity\Training;

/**
 * @method Training|null find($id, $lockMode = null, $lockVersion = null)
 * @method Training|null findOneBy(array $criteria, array $orderBy = null)
 * @method Training[]    findAll()
 * @method Training[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingRepository extends EntityRepository
{
}
