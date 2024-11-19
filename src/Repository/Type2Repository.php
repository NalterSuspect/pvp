<?php

namespace App\Repository;

use App\Entity\Type2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Type2>
 *
 * @method Type2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type2[]    findAll()
 * @method Type2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Type2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type2::class);
    }

//    /**
//     * @return Type2[] Returns an array of Type2 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Type2
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
