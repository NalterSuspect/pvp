<?php

namespace App\Entity;

use App\Repository\WinrateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WinrateRepository::class)]
class Winrate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idUser = null;

    #[ORM\Column(length: 255)]
    private ?string $typeQuestion = null;

    #[ORM\Column]
    private ?int $correctAnswer = 0;

    #[ORM\Column]
    private ?int $totalAnswers = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getTypeQuestion(): ?string
    {
        return $this->typeQuestion;
    }

    public function setTypeQuestion(string $typeQuestion): static
    {
        $this->typeQuestion = $typeQuestion;

        return $this;
    }

    public function getCorrectAnswer(): ?int
    {
        return $this->correctAnswer;
    }

    public function setCorrectAnswer(int $correctAnswer): static
    {
        $this->correctAnswer = $correctAnswer;

        return $this;
    }

    public function getTotalAnswers(): ?int
    {
        return $this->totalAnswers;
    }

    public function setTotalAnswers(int $totalAnswers): static
    {
        $this->totalAnswers = $totalAnswers;

        return $this;
    }
}
