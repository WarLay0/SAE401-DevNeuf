<?php

namespace App\Entity;

use App\Repository\MotPartieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotPartieRepository::class)]
class MotPartie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $mpEmplacement = null;

    #[ORM\Column(length: 255)]
    private ?string $mpCouleurJ1 = null;

    #[ORM\Column(length: 255)]
    private ?string $mpCouleurJ2 = null;

    #[ORM\Column(length: 255)]
    private ?string $mpJeton1 = null;

    #[ORM\Column(length: 255)]
    private ?string $mpJeton2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMpEmplacement(): ?string
    {
        return $this->mpEmplacement;
    }

    public function setMpEmplacement(string $mpEmplacement): self
    {
        $this->mpEmplacement = $mpEmplacement;

        return $this;
    }

    public function getMpCouleurJ1(): ?string
    {
        return $this->mpCouleurJ1;
    }

    public function setMpCouleurJ1(string $mpCouleurJ1): self
    {
        $this->mpCouleurJ1 = $mpCouleurJ1;

        return $this;
    }

    public function getMpCouleurJ2(): ?string
    {
        return $this->mpCouleurJ2;
    }

    public function setMpCouleurJ2(string $mpCouleurJ2): self
    {
        $this->mpCouleurJ2 = $mpCouleurJ2;

        return $this;
    }

    public function getMpJeton1(): ?string
    {
        return $this->mpJeton1;
    }

    public function setMpJeton1(string $mpJeton1): self
    {
        $this->mpJeton1 = $mpJeton1;

        return $this;
    }

    public function getMpJeton2(): ?string
    {
        return $this->mpJeton2;
    }

    public function setMpJeton2(string $mpJeton2): self
    {
        $this->mpJeton2 = $mpJeton2;

        return $this;
    }
}
