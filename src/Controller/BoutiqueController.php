<?php

namespace App\Controller;

use App\Service\PokemonService;
use App\Service\TypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;

class BoutiqueController extends AbstractController
{
    public function __construct(
    private readonly HttpClientInterface $httpClient,
    private PokemonService $pokemonService,
    private TypeService $typeService
    )
    {

    }


    #[Route('/boutique', name: 'app_boutique')]
    public function index(): Response
    {
        $listPokemon = $this->pokemonService->getAllPokemon();
        $listType = $this->typeService->getAllTypes();
        $generation = $this->pokemonService->getAllGeneration();

        return $this->render('boutique/index.html.twig', [
            'controller_name' => 'BoutiqueController',
            'list_pokemon' => $listPokemon,
            'liste_types' => $listType,
            'generation' => $generation,
        ]);
    }

    #[Route('/boutique/name/', name: 'boutique_load_pokemon_name')]
    public function showPokemonByLetter(Request $request ):Response{
        $search = $request->query->get('searchPokemon');
        $listPokemon = $this->pokemonService->findPokemonByStartLetter("$search");
        $listType = $this->typeService->getAllTypes();
        $generation = $this->pokemonService->getAllGeneration();

        return $this->render('boutique/index.html.twig', [
            'list_pokemon' => $listPokemon,
            'controller_name' => 'PokemonController',
            'liste_types' => $listType,
            'generation' => $generation,
        ]);
    }

    #[Route('/boutique/type/{name}', name: 'boutique_load_pokemon_type')]
    public function showPokemonByType($name ):Response{
        $type = $this->typeService->getOneTypeByName($name);
        $listPokemon = $this->pokemonService->findPokemonByType($type);
        $listType = $this->typeService->getAllTypes();
        $generation = $this->pokemonService->getAllGeneration();

        return $this->render('boutique/index.html.twig', [
            'list_pokemon' => $listPokemon,
            'controller_name' => 'PokemonController',
            'liste_types' => $listType,
            'generation' => $generation,
        ]);
    }

    #[Route('/boutique/gen/{id}', name: 'boutique_load_pokemon_gen')]
    public function showPokemonByGen( $id ):Response{
        $listPokemon = $this->pokemonService->findPokemonByGen($id,0);
        $listType = $this->typeService->getAllTypes();
        $generation = $this->pokemonService->getAllGeneration();

        return $this->render('boutique/index.html.twig', [
            'list_pokemon' => $listPokemon,
            'controller_name' => 'PokemonController',
            'liste_types' => $listType,
            'generation' => $generation,
        ]);
    }


}
