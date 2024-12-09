<?php

namespace App\Repository;

use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Type>
 *
 * @method Type|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type[]    findAll()
 * @method Type[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

//    /**
//     * @return Type[] Returns an array of Type objects
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

   public function findOneByName($name): ?Type
   {
       return $this->createQueryBuilder('t')
           ->andWhere('type.name = :$name')
           ->setParameter('val', $name)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
   public function updateTypeToEnglish(){
        $i= $this->findOneBy(['name'=>"Acier"])->getId();
        $eng_names = ['Steel','Figth','Dragon','Water','Electric','Fairy','Fire','Ice','Bug','Normal','Plant','Poison','Psychic','Rock','Ground','Ghost','Dark','Flying'];
        foreach ($eng_names as $name){
            $query = $this->createQueryBuilder('t')
                ->update(Type::class,'t')
                ->set('t.name',':eng')
                ->where('t.id = :i')
                ->setParameter('eng' ,$name)
                ->setParameter('i' , $i);
            $query->getQuery()->execute();
            $i++;
        }
   }

   public function getRandomType(){
        $types = $this->findAll();
        $id=$types[0]->getId();
        $idType=random_int($id,$id+count($types));
        return $this->findOneBy(['id'=>$idType]);
   }
}
