<?php
namespace App\Factory;

use App\Entity\Pokemon ;
use App\Entity\Type;

use App\Service\TypeService;
use Doctrine\ORM\EntityManagerInterface;

class PokemonFactory{
    public function __construct(
    private TypeService $typeService, private EntityManagerInterface $entityManager
    )
    {

    }

    public function createMultiplePokemonEntity($pokemonArray):array {

        $pokemonEntityArray = [];
        unset($pokemonArray[0]);
        //dd($pokemonArray);
        foreach($pokemonArray as $pokemon){
            $pokemonEntity= new Pokemon();
            $pokemonEntity->setName($pokemon["name"]["en"]);
            $pokemonEntity->setSprite($pokemon["sprites"]["regular"]);
            
            $type1 = $this->typeService->getOneTypeByName($pokemon["types"][0]["name"]);
            $pokemonEntity->setType1($type1);
            if(count($pokemon["types"]) == 2){
                $type2 = $this->typeService->getOneTypeByName( $pokemon["types"][1]["name"]);
                $pokemonEntity->setType2($type2);
            }
            $baseStatPokemon = $pokemon["stats"]["hp"]+
            $pokemon["stats"]["atk"]+
            $pokemon["stats"]["def"]+
            $pokemon["stats"]["spe_atk"]+
            $pokemon["stats"]["spe_def"]+
            $pokemon["stats"]["vit"];

            $pokemonEntity->setPrice($baseStatPokemon);
            $pokemonEntity->setGen($pokemon["generation"]);

            if(isset($pokemon["evolution"]["next"]) && isset($pokemon["evolution"]["pre"])) {
                if(count($pokemon["evolution"]["next"])==2){ 
                    // le pokémon à deux stade d'évolution
                    $pokemonEntity->setEvolutionTier(1);
                }elseif(count($pokemon["evolution"]["next"])==1){ 
                    // le pokémon à déjà évolué et peut encore évolué
                    $pokemonEntity->setEvolutionTier(2);
                }elseif(count($pokemon["evolution"]["pre"])==2){ 
                    // le pokémon est dans son stade d'évolution final
                    $pokemonEntity->setEvolutionTier(3);
                }
            }else {
                $pokemonEntity->setEvolutionTier(0);

            }
            $pokemonEntityArray[$pokemon["pokedex_id"]]=$pokemonEntity;
        }
        //dd($pokemonEntityArray);
        return $pokemonEntityArray;
    }

    function createAllTypes($typesArray):array{
        $typesEntityArray = [];
        foreach($typesArray as $type){
            $typeEntity = new Type;
            $typeEntity->setName($type["name"]["fr"]);
            $typeEntity->setSprite($type["sprites"]);

            $typesEntityArray[$type["id"]]=$typeEntity;
        }
        return $typesEntityArray;
    }

}