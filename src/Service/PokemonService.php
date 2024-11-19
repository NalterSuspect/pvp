<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Pokemon;
class PokemonService 
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {

    }

    function tablePokemonEmpty():bool{
        if(count($this->entityManager->getRepository(className: Pokemon::class)->findAll())==0){
            return true;
        }
        return false;
    }

    function getOnePokemonByName($name):Pokemon{
        return $this->entityManager->getRepository(className: Pokemon::class)->findOneBy(["name"=>$name]);
    }

    function createPokemon( Pokemon $pokemon): void {

            $this->entityManager->persist($pokemon);
            $this->entityManager->flush();
    }





}