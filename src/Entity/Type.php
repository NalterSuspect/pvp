<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sprite = null;

    #[ORM\OneToMany(targetEntity: Pokemon::class, mappedBy: 'type2')]
    private Collection $type2;

    #[ORM\OneToMany(targetEntity: Pokemon::class, mappedBy: 'type1', orphanRemoval: true)]
    private Collection $type1;

    public function __construct()
    {
        $this->type1 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
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
    public function getType2(): Collection
    {
        return $this->type2;
    }

    public function addType2(Pokemon $type2): static
    {
        if (!$this->type2->contains($type2)) {
            $this->type2->add($type2);
            $type2->setType2($this);
        }

        return $this;
    }

    public function removeType2(Pokemon $type2): static
    {
        if ($this->type2->removeElement($type2)) {
            // set the owning side to null (unless already changed)
            if ($type2->getType2() === $this) {
                $type2->setType2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getType1(): Collection
    {
        return $this->type1;
    }

    public function addType1(Pokemon $type1): static
    {
        if (!$this->type1->contains($type1)) {
            $this->type1->add($type1);
            $type1->setType1($this);
        }

        return $this;
    }

    public function removeType1(Pokemon $type1): static
    {
        if ($this->type1->removeElement($type1)) {
            // set the owning side to null (unless already changed)
            if ($type1->getType1() === $this) {
                $type1->setType1(null);
            }
        }

        return $this;
    }
}
