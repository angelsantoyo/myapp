<?php

namespace App\Repository;

use App\Entity\MembershipTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MembershipTypes>
 *
 * @method MembershipTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method MembershipTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method MembershipTypes[]    findAll()
 * @method MembershipTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembershipTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MembershipTypes::class);
    }

//    /**
//     * @return MembershipTypes[] Returns an array of MembershipTypes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MembershipTypes
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
