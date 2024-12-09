<?php

namespace App\Entity;

use App\Repository\Type2Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Type2Repository::class)]
class Type2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
