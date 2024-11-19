<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sprite = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;



    #[ORM\Column(nullable: true)]
    private ?int $evolutionTier = null;

    #[ORM\Column(nullable: true)]
    private ?int $gen = null;

    #[ORM\ManyToOne(inversedBy: 'type2')]
    private ?type $type2 = null;

    #[ORM\ManyToOne(inversedBy: 'type1')]
    #[ORM\JoinColumn(nullable: false)]
    private ?type $type1 = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSprite(): ?string
    {
        return $this->sprite;
    }

    public function setSprite(?string $sprite): static
    {
        $this->sprite = $sprite;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getEvolutionTier(): ?int
    {
        return $this->evolutionTier;
    }

    public function setEvolutionTier(?int $evolutionTier): static
    {
        $this->evolutionTier = $evolutionTier;

        return $this;
    }

    public function getGen(): ?int
    {
        return $this->gen;
    }

    public function setGen(?int $gen): static
    {
        $this->gen = $gen;

        return $this;
    }

    public function getType2(): ?type
    {
        return $this->type2;
    }

    public function setType2(?type $type2): static
    {
        $this->type2 = $type2;

        return $this;
    }

    public function getType1(): ?type
    {
        return $this->type1;
    }

    public function setType1(?type $type1): static
    {
        $this->type1 = $type1;

        return $this;
    }

}
