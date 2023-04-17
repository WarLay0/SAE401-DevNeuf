<?php

namespace App\Entity;

use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatsRepository::class)]
class Stats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable : true)]
    private ?int $partiesGagnees = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $partiesPerdues = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $partiesJouees = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartiesGagnees(): ?int
    {
        return $this->partiesGagnees;
    }

    public function setPartiesGagnees(int $partiesGagnees): self
    {
        $this->partiesGagnees = $partiesGagnees;

        return $this;
    }

    public function getPartiesPerdues(): ?int
    {
        return $this->partiesPerdues;
    }

    public function setPartiesPerdues(?int $partiesPerdues): self
    {
        $this->partiesPerdues = $partiesPerdues;

        return $this;
    }

    public function getPartiesJouees(): ?int
    {
        return $this->partiesJouees;
    }

    public function setPartiesJouees(?int $partiesJouees): self
    {
        $this->partiesJouees = $partiesJouees;

        return $this;
    }
}
