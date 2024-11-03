<?php

namespace App\Controller;

use App\Service\PokemonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;



class PokemonController extends AbstractController
{
    public function __construct(private readonly PokemonService  $pokemonService,
    private readonly HttpClientInterface $httpClient,
    )
    {}


    #[Route('/pokemon', name: 'app_home')]
    public function index(): Response
    {
        $this->pokemonService->getAllPokemonTypes();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
