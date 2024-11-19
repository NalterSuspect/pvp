<?php

namespace App\Controller;

use App\Service\TypeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Factory\PokemonFactory;
use App\Service\ApiService;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TypeController extends AbstractController
{
    public function __construct(private readonly ApiService  $apiService,
    private readonly HttpClientInterface $httpClient,
    private PokemonFactory $pokemonFactory,
    private TypeService $typeService,
    )
    {

    }

    #[Route('/type', name: 'app_type')]
    public function index(): Response
    {
        return $this->render('type/index.html.twig', [
            'controller_name' => 'TypeController',
        ]);
    }

    #[Route('/createAllPokemonTypes', name: 'types_create_all')]
    public function createAllTypes():Response
    {
        if($this->typeService->canCreateNewTypes()){
            $typesArray = $this->apiService->getAllPokemonTypes();
            $typesEntity = $this->pokemonFactory->createAllTypes($typesArray);
    
            foreach($typesEntity as $typeEntity){
                $this->typeService->createType($typeEntity);
            }
        }
        
        return $this->redirectToRoute(route: "app_home");

    }
}
