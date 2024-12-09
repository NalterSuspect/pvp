<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Type;
use App\Entity\User;


use App\Entity\Pokemon;
class PokemonService 
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserService $userService

    )
    {

    }

    function tablePokemonEmpty():bool{
        if(count($this->entityManager->getRepository(className: Pokemon::class)->findAll())==0){
            return true;
        }
        return false;
    }

    function getOnePokemonByName($name):?Pokemon{
        return $this->entityManager->getRepository(className: Pokemon::class)->findOneBy(['name'=> $name]);
    }

    function createPokemon( Pokemon $pokemon): void {

            $this->entityManager->persist($pokemon);
            $this->entityManager->flush();
    }

    function getAllPokemon():array {
        return $this->entityManager->getRepository(Pokemon::class)->findAll();
    }  

    function findPokemonByStartLetter(string $letter): array{
        return $this->entityManager->getRepository(Pokemon::class)->findPokemonWithStartLetter($letter);
        
    }

    function findPokemonByType(Type $type): array{
        return $this->entityManager->getRepository(Pokemon::class)->findPokemonWithType($type->getId());
        
    }

    function findPokemonByGen(int $gen,$offset): array{
        return $this->entityManager->getRepository(Pokemon::class)->findBy(array("gen" => $gen),null,30,$offset);
        
    }

    function getAllGeneration():array {
        return $this->entityManager->getRepository(Pokemon::class)->getAllGen();
    }

    function findPokemon(int $id):Pokemon{
        return $this->entityManager->getRepository(Pokemon::class)->find($id);
    }

    function addPokemonToUser(int $id,User $user):array {
        $pokemon = $this->findPokemon($id);
        if($pokemon->getPrice() > $user->getMoney()){
            return ['status'=> 400, 'error'=>'Pas assez d\'argent pour acheter ce pokémon'];
        }
        if($this->userService->userPossessPokemon($pokemon, $user)){
            return ['status'=> 400, 'error'=>'user possede deja ce pokemon'];
        }else{
            $user->addPokemonOfUser(pokemonOfUser: $pokemon);
            $user->setMoney($user->getMoney()-$pokemon->getPrice());
            $this->entityManager->flush();
            return ['status'=> 200];
        }

        

    }


}