<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Type;

use App\Entity\User;
use App\Entity\Pokemon;

class UserService 
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {

    }

    function getUserMoney(string $username):int{
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username'=>$username]);
        return $user->getMoney();
    }

    function getPokemonOfUser(string $username): array{
        return $this->entityManager->getRepository(User::class)->findPokemonOfUser($username);
    }

}
