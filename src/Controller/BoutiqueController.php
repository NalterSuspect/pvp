<?php

namespace App\Controller;

use App\Form\SelectGenFormType;
use App\Service\PokemonService;
use App\Service\TypeService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class BoutiqueController extends AbstractController
{
    public function __construct(
    private readonly HttpClientInterface $httpClient,
    private PokemonService $pokemonService,
    private TypeService $typeService,
    private UserService $userService,
    )
    {

    }


    #[Route('/boutique', name: 'app_boutique')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SelectGenFormType::class);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData()["select_field"];
            return $this->redirect("/boutique/gen/$data");
        }

        $listPokemon = $this->pokemonService->getAllPokemon();
        $listType = $this->typeService->getAllTypes();

        return $this->render('boutique/index.html.twig', [
            'controller_name' => 'BoutiqueController',
            'list_pokemon' => $listPokemon,
            'liste_types' => $listType,
            'formGen' => $form->createView(),
            'money' => $this->getUser()->getMoney(),
        ]);
    }

    #[Route('/boutique/name/', name: 'boutique_load_pokemon_name')]
    public function showPokemonByLetter(Request $request ):Response{
        $search = $request->query->get('searchPokemon');
        $listPokemon = $this->pokemonService->findPokemonByStartLetter("$search");
        $listType = $this->typeService->getAllTypes();
        $form = $this->createForm(SelectGenFormType::class);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData()["select_field"];
            return $this->redirect("/boutique/gen/$data");
        }

        return $this->render('boutique/frame.html.twig', [
            'list_pokemon' => $listPokemon,
            'controller_name' => 'PokemonController',
            'liste_types' => $listType,
            'formGen' => $form->createView(),
            'money' => $this->getUser()->getMoney(),
        ]);
    }

    #[Route('/boutique/type/{name}', name: 'boutique_load_pokemon_type')]
    public function showPokemonByType($name, Request $request ):Response{
        $type = $this->typeService->getOneTypeByName($name);
        $listPokemon = $this->pokemonService->findPokemonByType($type);
        $listType = $this->typeService->getAllTypes();
        $form = $this->createForm(SelectGenFormType::class);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData()["select_field"];
            return $this->redirect("/boutique/gen/$data");
        }
        return $this->render('boutique/frame.html.twig', [
            'list_pokemon' => $listPokemon,
            'controller_name' => 'PokemonController',
            'liste_types' => $listType,
            'formGen' => $form->createView(),
            'money' => $this->getUser()->getMoney(),
        ]);
    }

    #[Route('/boutique/gen/{id}', name: 'boutique_load_pokemon_gen')]
    public function showPokemonByGen( $id,Request $request ):Response{
        $listPokemon= $this->pokemonService->findPokemonByGen($id,1);
        $listType = $this->typeService->getAllTypes();
        $form = $this->createForm(SelectGenFormType::class);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        }

        return $this->render('boutique/index.html.twig', [
            'list_pokemon' => $listPokemon,
            'liste_types' => $listType,
            'controller_name' => 'PokemonController',
            'formGen' => $form->createView(),
            'money' => $this->getUser()->getMoney(),
        ]);
    }

    #[Route('/boutique/buy/{id}', name: 'boutique_buy_pokemon')]
    public function buyPokemon( $id ):Response{
        $user= $this->userService->getUser();
        $response = $this->pokemonService->addPokemonToUser($id, $user);


        if($response["status"]==200){
            return new Response("<p>Vous avez bien acheter ce pokémon</p>");
        }elseif($response["status"]==400){
            return new Response("<p>$response[error]</p>");
        }else{
            return new Response("<p>un probleme a ete rencontre lors de votre achat</p>");
        }
    }


}
