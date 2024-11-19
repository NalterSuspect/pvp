<?php

namespace App\Repository;

use App\Entity\Winrate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Winrate>
 *
 * @method Winrate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Winrate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Winrate[]    findAll()
 * @method Winrate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WinrateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Winrate::class);
    }

//    /**
//     * @return Winrate[] Returns an array of Winrate objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Winrate
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
