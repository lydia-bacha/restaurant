<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Reservation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    // des réservations passées 
    public function findReservationsPasses(){
        $qb=$this->createQueryBuilder("e");
        $qb->andWhere("e.date < :date")
        ->setParameter("date", new \Datetime)
        ->orderBy('e.date', 'DESC')
        ;
        return $qb->getQuery()->getResult();
    }

    // des réservations à venir
    public function findReservationsFuture(){
        $qb=$this->createQueryBuilder("e");
        $qb->andWhere("e.date > :date")
        ->setParameter("date", new \Datetime)
        ->orderBy('e.date', 'DESC')
        ;
        return $qb->getQuery()->getResult();
    }




    // public function findByUser(User $user){
    //     $qb= $this->createQueryBuilder("u")
    //      ->andWhere("u.id = :user")
    //      ->setParameters([
    //          "user"=>$user->getId()
    //      ]);
 
    //      return $qb->getQuery()->getResult();
    //  }






    // /**
    //  * @return Reservation[] Returns an array of Reservation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reservation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
