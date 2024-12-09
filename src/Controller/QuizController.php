<?php

namespace App\Controller;

use App\Entity\Question;
use App\Service\PokemonService;
use App\Service\QuestionService;
use App\Service\UserService;
use App\Form\CreateQuestionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    public function __construct(
        private QuestionService $questionService,
        private readonly PokemonService $pokemonService,
        private readonly UserService $userService,
        private EntityManagerInterface $entityManager,
    )
    {
    }
    #[Route('/quiz', name: 'index_quiz')]
    public function index(): Response
    {
        return $this->render('quiz/index.html.twig', [
            'controller_name' => 'QuizController',
        ]);
    }
    #[Route('/quiz/create', name: 'create_quiz')]
    public function create(Request $request): Response
    {
        $QuestionService = new QuestionService($this->entityManager);
        $question = new Question();
        $createQuestionForm = $this->createForm(CreateQuestionFormType::class, $question);
        $createQuestionForm->handleRequest($request);

        if ($createQuestionForm->isSubmitted() && $createQuestionForm->isValid()) {
            $QuestionService->createQuestion($createQuestionForm->getData(),$this->getUser()->getId());
        }

        $questions = $QuestionService->getQuestionsByUserId($this->getUser()->getId());

        return $this->render('quiz/create.html.twig', [
            'createQuestionForm' => $createQuestionForm->createView(),
            'questions' => $questions,
        ]);
    }

    #[Route('/quiz/play/{id}', name: 'quiz_play')]
    public function play(Request $request,$id): Response
    {
        $number = $id;
        $prompt = $this->questionService->getRandomQuestion();
        if(isset($prompt['type'])){
            $defaultData = [
                'message' => $prompt['type'],
                'question_type'=>'type',
            ];
        }elseif(isset($prompt['gen'])){
            $defaultData = [
                'message' => $prompt['gen'],
                'question_type'=>'gen',
            ];
        }
        elseif(isset($prompt['letter'])){
            $defaultData = [
                'message' => $prompt['letter'],
                'question_type'=>'letter',
            ]; 
        }

        $form = $this->createFormBuilder($defaultData)
            ->add('answer', TextType::class)
            ->add('type', TextType::class, [
                'attr' => ['value' => $defaultData['message']]
            ])
            ->add('typeQ', TextType::class, [
                'attr' => ['value' => $defaultData['question_type']]
            ])
            ->add('next', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $pokemon_name=ucfirst($form->getData()['answer']);
            $question_type=$form->getData()['typeQ'];
            $type_required=$form->getData()['type'];
            $pokemon = $this->pokemonService->getOnePokemonByName($pokemon_name);

            if($pokemon!=null){
                if($question_type == "type") {
                    //dd("TYPE question : $type_required answer : ".$pokemon->getType1()->getName());

                    if($pokemon->getType2() == null){
                        if ($pokemon->getType1()->getName()==$type_required){
                            $this->userService->addMoneyPerQuestion($this->getUser());
                            return $this->redirectToRoute('quiz_play',['id'=>$id+1]);
                        }
                    }else{
                        if ($pokemon->getType1()->getName()==$type_required || $pokemon->getType2()->getName()==$type_required){
                            $this->userService->addMoneyPerQuestion($this->getUser());
                            return $this->redirectToRoute('quiz_play',['id'=>$id+1]);
                        }
                    }    

                }elseif($question_type == "gen"){
                    $gen_required=$form->getData()['type'];
                    //dd("GEN question : $gen_required answer : ".$pokemon->getGen());
                    if($pokemon->getGen() == $gen_required){
                        $this->userService->addMoneyPerQuestion($this->getUser());
                        return $this->redirectToRoute('quiz_play',['id'=>$id+1]);
                    }
                }elseif($question_type == "letter"){
                    
                    $letter_required=mb_strtolower($form->getData()['type']);
                    $letter_answered =mb_strtolower($pokemon->getName()[0]);
                    //dd("LETTER question : $letter_required answer : ".$letter_answered);
                    if($letter_answered == $letter_required){
                        $this->userService->addMoneyPerQuestion($this->getUser());
                        return $this->redirectToRoute('quiz_play',['id'=>$id+1]);
                    }

                }


            }

            return $this->redirectToRoute('quiz_play',['id'=>$id+1]);
        }
        return $this->render('quiz/play.html.twig', [
            'controller_name' => 'QuizController',
            'number' => $number,
            'question' => $prompt['question'],
            'form' => $form->createView(),
            'money' => $this->getUser()->getMoney(),
        ]);
    }

    #[Route('/quiz/reset', name: 'quiz_reset')]
    public function restart(Request $request): Response{
        //$this->questionService->resetAnswers();
        dd($_COOKIE["answers"]);
        return $this->redirectToRoute('quiz_play',['id'=>1]);
    }
}
