<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prompt = null;

    #[ORM\Column(length: 255)]
    private ?string $answer = null;

    #[ORM\Column(length: 255)]
    private ?string $option1= null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $option2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $option3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $option4 = null;

    #[ORM\Column]
    private ?int $idUser = null;

    #[ORM\Column]
    private ?int $totalCount = 0;

    #[ORM\Column]
    private ?int $rightCount = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrompt(): ?string
    {
        return $this->prompt;
    }

    public function setPrompt(string $prompt): static
    {
        $this->prompt = $prompt;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function getOption1(): ?string
    {
        return $this->option1;
    }

    public function setOption1(string $option1): static
    {
        $this->option1 = $option1;

        return $this;
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

    public function getTotalCount(): ?int
    {
        return $this->totalCount;
    }

    public function setTotalCount(int $totalCount): static
    {
        $this->totalCount = $totalCount;

        return $this;
    }

    public function getRightCount(): ?int
    {
        return $this->rightCount;
    }

    public function setRightCount(int $rightCount): static
    {
        $this->rightCount = $rightCount;

        return $this;
    }

    public function getOption2(): ?string
    {
        return $this->option2;
    }

    public function setOption2(?string $option2): static
    {
        $this->option2 = $option2;

        return $this;
    }

    public function getOption3(): ?string
    {
        return $this->option3;
    }

    public function setOption3(?string $option3): static
    {
        $this->option3 = $option3;

        return $this;
    }

    public function getOption4(): ?string
    {
        return $this->option4;
    }

    public function setOption4(?string $option4): static
    {
        $this->option4 = $option4;

        return $this;
    }
}
