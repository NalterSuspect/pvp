<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Type;
class TypeService 
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {

    }

    function canCreateNewTypes():bool{
        if(count($this->entityManager->getRepository(className: Type::class)->findAll())==0){
            return true;
        }
        return false;
    }

    function getOneTypeByName($name):Type{
        return $this->entityManager->getRepository(className: Type::class)->findOneBy(["name"=>$name]);
    }

    function createType( Type $type): void {

            $this->entityManager->persist($type);
            $this->entityManager->flush();
    }

    function getAllTypes():array{
        return $this->entityManager->getRepository(Type::class)->findAll();
    }
    public function getRandomType():Type{
        return $this->entityManager->getRepository(className: Type::class)->getRandomType();
    }

    public function setTypeToEnglish(): void{
        $this->entityManager->getRepository(className: Type::class)->updateTypeToEnglish();
    }
}