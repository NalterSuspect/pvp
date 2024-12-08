<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PokemonService;
use App\Service\TypeService;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class ClickController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private PokemonService $pokemonService,
        private UserService $userService,
        private TypeService $typeService
        )
        {
    
        }

    #[Route('/', name: 'app_click')]
    public function index(): Response
    {
        return $this->render('click/index.html.twig', [
            'controller_name' => 'ClickController',
        ]);
    }

    #[Route('/click', name: 'app_click')]
    public function clickOnPokemon(): Response
    {
        $user = get_current_user();
        $user;
        return $this->render('click/index.html.twig', [
            'controller_name' => 'ClickController',
        ]);
    }

    #[Route('/displayPokemon', name: 'app_display_pokemon')]
    public function displayPokemon(): Response
    {
        $user = $this->userService->getUser();
        $pokemon = $this->userService->getPokemonOfUser($user->getUsername());
        foreach($pokemon as $p){
            $randomPokemon=$p->getPokemonOfUser()->toArray();
        }
        $randomPokemon=$randomPokemon[rand(0,count($randomPokemon)-1)];
        $money = $user->getMoney();
        //dd($randomPokemon);
        return $this->render('click/index.html.twig', [
            'controller_name' => 'ClickController',
            'pokemon'=> $randomPokemon,
            'money'=>$money,
            
        ]);
    }

    #[Route('/addMoney', name: 'app_add_money')]
    public function addMoney(): Response
    {
        $user = $this->userService->getUser();
        $this->userService->addMoney($user);
        return new Response("$ : ".$user->getMoney());
    }


}
