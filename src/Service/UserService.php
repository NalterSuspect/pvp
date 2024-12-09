<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Type;

use App\Entity\User;
use App\Entity\Pokemon;
use Symfony\Component\Security\Core\Security;

class UserService 
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private Security $security
    )
    {

    }

    function getUser():User{
        return $this->security->getUser();
    }

    function getUserMoney(string $username):int{
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username'=>$username]);
        return $user->getMoney();
    }

    function getPokemonOfUser(string $username):array {
        return $this->entityManager->getRepository(User::class)->findPokemonOfUser($username);
    }

    function addMoney(User $user){
        $user->setMoney($user->getMoney()+1);
        $this->entityManager->flush();
        //$this->entityManager->flush();
    }

    function userPossessPokemon(Pokemon $pokemon,User $user): bool{
        $pokemonOfUser = $this->getPokemonOfUser($user->getUsername());
        return in_array($pokemon,$pokemonOfUser );
    }

}
