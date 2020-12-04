<?php

namespace App\Repository;

use App\Entity\Vina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Vina|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vina|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vina[]    findAll()
 * @method Vina[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VinaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vina::class);
    }

    // /**
    //  * @return Vina[] Returns an array of Vina objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vina
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
