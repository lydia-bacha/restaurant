<?php

namespace App\Repository;

use App\Entity\Gallerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gallerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gallerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gallerie[]    findAll()
 * @method Gallerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GallerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gallerie::class);
    }

    // /**
    //  * @return Gallerie[] Returns an array of Gallerie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gallerie
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
