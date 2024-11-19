<?php

namespace App\Controller;

use App\Factory\PokemonFactory;
use App\Service\ApiService;
use App\Service\PokemonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;

class PokemonController extends AbstractController
{

    public function __construct(private readonly ApiService  $apiService,
    private readonly HttpClientInterface $httpClient,
    private PokemonFactory $pokemonFactory,
    private PokemonService $pokemonService
    )
    {

    }


    #[Route('/pokemon', name: 'pokemon_home')]
    public function index(): Response
    {
        $hello = $this->apiService->getOnePokemon(12);
        dd($hello);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/createAllPokemon', name: 'pokemon_create_all')]
    public function createAllPokemon():Response
    {
        if($this->pokemonService->tablePokemonEmpty()) {
            $pokemonArray = $this->apiService->getAllPokemon();
            $pokemonEntityArray = $this->pokemonFactory->createMultiplePokemonEntity($pokemonArray);
    
            foreach($pokemonEntityArray as $pokemonEntity) {
                $this->pokemonService->createPokemon($pokemonEntity);
            }
        }
        
        return $this->redirectToRoute(route: "app_home");

    }

    #[Route('/boutique', name: 'pokemon_boutique')]
    public function boutique():Response{
        $listPokemon = $this->pokemonService->findPokemonByStartLetter('g');
    
        //dd($listPokemon);
        return $this->render('pokemon/boutique.html.twig', [
            'list_pokemon' => $listPokemon,
            'controller_name' => 'PokemonController',
        ]);
    }

    
}
