<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pokemon>
 *
 * @method Pokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pokemon[]    findAll()
 * @method Pokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

   /**
    * @return Pokemon[] Returns an array of Pokemon objects
    */
   public function findPokemonWithStartLetter($letter): array
   {
       $query=  $this->createQueryBuilder('p')
           ->andWhere('p.name LIKE :letter')
           ->setParameter('letter', $letter . '%');

        $query=$query->getQuery();
        return $query->execute();
   }

   public function getAllGen()
   {
       $query=  $this->createQueryBuilder('p')->groupBy('p.gen');
       $query=$query->getQuery();
       return $query->getResult();
   }

//    public function findOneBySomeField($value): ?Pokemon
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
