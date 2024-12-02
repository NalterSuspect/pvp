<?php

namespace App\Service;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\TypeService;
use PhpParser\Node\Name;
use App\Entity\Question;

class QuestionService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ){
    }

    public function getQuestionsByUserId($userId){
        return $this->entityManager->getRepository(className: Question::class)->getQuestionsByUserId($userId);
    }

    public function createQuestion($data,$userId){
        $question = $data;
        $data->setIdUser($userId);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
    public function getTypePokemonQuestion():string
    {
        $TyperService= new TypeService($this->entityManager);
        $type = $TyperService->getRandomType();
        return 'Give a '.$type->getName().' type Pokemon !';
    }

    function getGenPokemonQuestion():string
    {
        $gen=$this->entityManager->getRepository(className: Pokemon::class)->getAllGen();
        $num = random_int(1,count($gen));
        return 'Give a generation '.$num.' pokemon !';
    }

    function getNamePokemonQuestion():string
    {
        $chars='ABCDEFGHIJKMLOPQRSTUVWXYZ';
        return 'Name a pokemon that starts with '.$chars[random_int(1,strlen($chars))].' ! ';
    }
}