<?php

namespace App\Service;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\TypeService;
use PhpParser\Node\Name;
use App\Entity\Question;

class QuestionService
{
    public function startAnswers()
    {
        $answer_results=[-1,-1,-1,-1,-1,-1,-1,-1,-1,-1];
        if (!isset($_COOKIE["answers"]))
            setcookie("answers", serialize($answer_results), time() + 3600);
    }

    public function resetAnswers()
    {
        $answer_results=[-1,-1,-1,-1,-1,-1,-1,-1,-1,-1];
        if (isset($_COOKIE["answers"]))
            setcookie("answers", serialize($answer_results), time() + 3600);
    }
    public function getAnswerResults(): array
    {
        if (isset($_COOKIE["answers"])){
            return unserialize($_COOKIE["answers"]);
        }
        return [];
    }

    public function addAnswerResults(int $index,int $answer): void
    {
        $arr = unserialize($_COOKIE["answers"]);
        $arr[$index-1] = $answer;
        setcookie("answers", serialize($arr), time() + 3600);
    }
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
    public function getTypePokemonQuestion():array
    {
        $TyperService= new TypeService($this->entityManager);
        $type = $TyperService->getRandomType();
        return ['type'=> $type->getName(), 'question' => 'Give a '.$type->getName().' type Pokemon !'];
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
        return 'Name a pokemon that starts with '.$chars[random_int(0,strlen($chars)-1)].' ! ';
    }

    public function getRandomQuestion() :array
    {
        $rand = 0; // random_int(0,2)
        switch ($rand){
            case 0: return $this->getTypePokemonQuestion();
                break;
            case 1:return $this->getGenPokemonQuestion();
                break;
            case 2:return $this->getNamePokemonQuestion();
                break;
        }
        return ['response' => "no question generate lol?"];
    }
}