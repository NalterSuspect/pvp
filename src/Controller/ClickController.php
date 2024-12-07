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

    #[Route('/displayPokemon', name: 'app_click')]
    public function displayPokemon(): Response
    {
        $user = get_current_user();
        $pokemon = $this->userService->getPokemonOfUser($user);
        $randomPokemon = random_int(1, count($pokemon)-1);

        $money = $this->userService->getUserMoney($user);

        return $this->render('click_page/index.html.twig', [
            'controller_name' => 'ClickController',
            'pokemon_displayed'=> $randomPokemon,
            'money'=>$money,
            
        ]);
    }




}
