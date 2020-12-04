<?php

namespace App\Repository;

use App\Entity\Vinarije;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Vinarije|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vinarije|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vinarije[]    findAll()
 * @method Vinarije[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VinarijeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vinarije::class);
    }

    // /**
    //  * @return Vinarije[] Returns an array of Vinarije objects
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
    public function findOneBySomeField($value): ?Vinarije
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
