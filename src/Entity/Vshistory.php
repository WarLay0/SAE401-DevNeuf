<?php

namespace App\Entity;

use App\Repository\VshistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VshistoryRepository::class)]
class Vshistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomAdversaire = null;

    #[ORM\Column]
    private ?int $nbVS = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAdversaire(): ?string
    {
        return $this->nomAdversaire;
    }

    public function setNomAdversaire(string $nomAdversaire): self
    {
        $this->nomAdversaire = $nomAdversaire;

        return $this;
    }

    public function getNbVS(): ?int
    {
        return $this->nbVS;
    }

    public function setNbVS(int $nbVS): self
    {
        $this->nbVS = $nbVS;

        return $this;
    }
}
