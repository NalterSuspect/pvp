<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Winrate;
use App\Form\CreateQuestionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    #[Route('/quiz', name: 'app_quiz')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $question= new Question();
        $createQuestionForm = $this->createForm(CreateQuestionFormType::class, $question);

        $createQuestionForm->handleRequest($request);
        if ($createQuestionForm->isSubmitted() && $createQuestionForm->isValid()) {
            $data = $createQuestionForm->getData();
            $data->setIdUser($this->getUser()->getId());

            $entityManager->persist($data);
            $entityManager->flush();
        }

        $questions=$entityManager->getRepository(Question::class)->findAll();

        $arr=["basic","advance","expert","custom"];
//        foreach ($arr as $a) {
//            $winrate= new Winrate();
//            $winrate->setIdUser($this->getUser()->getId());
//            $winrate->setTypeQuestion($a);
//            $winrate->setCorrectAnswer(0);
//            $winrate->setTotalAnswers(0);
//            $entityManager->persist($winrate);
//            $entityManager->flush();
//        }

        return $this->render('quiz/index.html.twig', [
            'controller_name' => 'QuizController',
            'createQuestionForm' => $createQuestionForm->createView(),
            'questions' => $questions,
        ]);
    }
}
