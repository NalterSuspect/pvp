<?php

namespace App\Controller;

use App\Factory\PokemonFactory;
use App\Service\ApiService;
use App\Service\PokemonService;
use App\Service\TypeService;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Type;

class InitController extends AbstractController
{

    public function __construct(private readonly ApiService  $apiService,
    private readonly HttpClientInterface $httpClient,
    private PokemonFactory $pokemonFactory,
    private PokemonService $pokemonService,
    private TypeService $typeService,
    private UserService $userService
    
    )
    {

    }

    #[Route('/init', name: 'app_init')]
    public function init(): Response
    {
        $user = $this->userService->getUser();

        if($this->typeService->canCreateNewTypes()){
            $typesArray = $this->apiService->getAllPokemonTypes();
            $typesEntity = $this->pokemonFactory->createAllTypes($typesArray);
    
            foreach($typesEntity as $typeEntity){
                $this->typeService->createType($typeEntity);
            }
        }

        if($this->pokemonService->tablePokemonEmpty()) {
            $pokemonArray = $this->apiService->getAllPokemon();
            $pokemonEntityArray = $this->pokemonFactory->createMultiplePokemonEntity($pokemonArray);
    
            foreach($pokemonEntityArray as $pokemonEntity) {
                $this->pokemonService->createPokemon($pokemonEntity);
            }
        }
        if(count($user->getPokemonOfUser())==0){
            $this->pokemonService->addFirstPokemon( $user);
        }

        $this->typeService->setTypeToEnglish();

        return $this->redirect('/displayPokemon');
    }

    

}
