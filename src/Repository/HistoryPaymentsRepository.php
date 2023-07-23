<?php

namespace App\Repository;

use App\Entity\HistoryPayments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HistoryPayments>
 *
 * @method HistoryPayments|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoryPayments|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoryPayments[]    findAll()
 * @method HistoryPayments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoryPaymentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoryPayments::class);
    }

//    /**
//     * @return HistoryPayments[] Returns an array of HistoryPayments objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HistoryPayments
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
