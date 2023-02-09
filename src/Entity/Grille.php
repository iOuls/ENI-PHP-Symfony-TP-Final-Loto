<?php

namespace App\Entity;

use App\Repository\GrilleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GrilleRepository::class)]
class Grille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[Assert\NotBlank(message: 'Le #1 ne peut pas être vide.')]
    #[Assert\Range(
        min: 1, max: 49,
        notInRangeMessage: 'Le #1 doit être entre 1 et 49.')
    ]
    #[ORM\Column]
    private ?int $numero1 = null;

    #[Assert\NotBlank(message: 'Le #2 ne peut pas être vide.')]
    #[Assert\Range(
        min: 1, max: 49,
        notInRangeMessage: 'Le #2 doit être entre 1 et 49.')
    ]
    #[ORM\Column]
    private ?int $numero2 = null;

    #[Assert\NotBlank(message: 'Le #3 ne peut pas être vide.')]
    #[Assert\Range(
        min: 1, max: 49,
        notInRangeMessage: 'Le #3 doit être entre 1 et 49.')
    ]
    #[ORM\Column]
    private ?int $numero3 = null;

    #[Assert\NotBlank(message: 'Le #4 ne peut pas être vide.')]
    #[Assert\Range(
        min: 1, max: 49,
        notInRangeMessage: 'Le #4 doit être entre 1 et 49.')
    ]
    #[ORM\Column]
    private ?int $numero4 = null;

    #[Assert\NotBlank(message: 'Le #5 ne peut pas être vide.')]
    #[Assert\Range(
        min: 1, max: 49,
        notInRangeMessage: 'Le #5 doit être entre 1 et 49.')
    ]
    #[ORM\Column]
    private ?int $numero5 = null;

    #[Assert\NotBlank(message: 'Le # Chance ne peut pas être vide.')]
    #[Assert\Range(
        min: 1, max: 10,
        notInRangeMessage: 'Le # Chance doit être entre 1 et 10.')
    ]
    #[ORM\Column]
    private ?int $numeroChance = null;

    #[ORM\ManyToOne(inversedBy: 'grilles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $tiree = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNumero1(): ?int
    {
        return $this->numero1;
    }

    public function setNumero1(int $numero1): self
    {
        $this->numero1 = $numero1;

        return $this;
    }

    public function getNumero2(): ?int
    {
        return $this->numero2;
    }

    public function setNumero2(int $numero2): self
    {
        $this->numero2 = $numero2;

        return $this;
    }

    public function getNumero3(): ?int
    {
        return $this->numero3;
    }

    public function setNumero3(int $numero3): self
    {
        $this->numero3 = $numero3;

        return $this;
    }

    public function getNumero4(): ?int
    {
        return $this->numero4;
    }

    public function setNumero4(int $numero4): self
    {
        $this->numero4 = $numero4;

        return $this;
    }

    public function getNumero5(): ?int
    {
        return $this->numero5;
    }

    public function setNumero5(int $numero5): self
    {
        $this->numero5 = $numero5;

        return $this;
    }

    public function getNumeroChance(): ?int
    {
        return $this->numeroChance;
    }

    public function setNumeroChance(int $numeroChance): self
    {
        $this->numeroChance = $numeroChance;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isTiree(): ?bool
    {
        return $this->tiree;
    }

    public function setTiree(bool $tiree): self
    {
        $this->tiree = $tiree;

        return $this;
    }
}
