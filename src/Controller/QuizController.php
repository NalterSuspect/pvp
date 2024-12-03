<?php

namespace App\Controller;

use App\Entity\Question;
use App\Service\QuestionService;
use App\Form\CreateQuestionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    public function __construct(
        private readonly QuestionService $questionService,
        private EntityManagerInterface $entityManager
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

        return $this->render('quiz/createQuiz.html.twig', [
            'controller_name' => 'QuizController',
            'createQuestionForm' => $createQuestionForm->createView(),
            'questions' => $questions,
        ]);
    }

    #[Route('/quiz/play', name: 'play_quiz')]
    public function play(): Response
    {
        dd($this->questionService->getTypePokemonQuestion());
        //dd($this->questionService->getGenPokemonQuestion());
        //dd($this->questionService->getNamePokemonQuestion());

        return $this->render('quiz/playQuiz.html.twig', [
            'controller_name' => 'QuizController',
        ]);
    }
}
