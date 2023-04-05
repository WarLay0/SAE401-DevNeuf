<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $partieEtat = null;

    #[ORM\Column(length: 255)]
    private ?string $partieJoueur1 = null;

    #[ORM\Column(length: 255)]
    private ?string $partieJoueur2 = null;

    #[ORM\Column]
    private ?int $partieNBTour = null;

    #[ORM\Column(length: 255)]
    private ?string $partieJoueurTour = null;

    #[ORM\Column(length: 255)]
    private ?string $partieCreateur = null;

    #[ORM\Column(length: 255)]
    private ?string $partieVictoire = null;

    #[ORM\OneToMany(mappedBy: 'partie', targetEntity: MotPartie::class)]
    private Collection $motParties;

    public function __construct()
    {
        $this->motParties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartieEtat(): ?string
    {
        return $this->partieEtat;
    }

    public function setPartieEtat(string $partieEtat): self
    {
        $this->partieEtat = $partieEtat;

        return $this;
    }

    public function getPartieJoueur1(): ?string
    {
        return $this->partieJoueur1;
    }

    public function setPartieJoueur1(string $partieJoueur1): self
    {
        $this->partieJoueur1 = $partieJoueur1;

        return $this;
    }

    public function getPartieJoueur2(): ?string
    {
        return $this->partieJoueur2;
    }

    public function setPartieJoueur2(string $partieJoueur2): self
    {
        $this->partieJoueur2 = $partieJoueur2;

        return $this;
    }

    public function getPartieNBTour(): ?int
    {
        return $this->partieNBTour;
    }

    public function setPartieNBTour(int $partieNBTour): self
    {
        $this->partieNBTour = $partieNBTour;

        return $this;
    }

    public function getPartieJoueurTour(): ?string
    {
        return $this->partieJoueurTour;
    }

    public function setPartieJoueurTour(string $partieJoueurTour): self
    {
        $this->partieJoueurTour = $partieJoueurTour;

        return $this;
    }

    public function getPartieCreateur(): ?string
    {
        return $this->partieCreateur;
    }

    public function setPartieCreateur(string $partieCreateur): self
    {
        $this->partieCreateur = $partieCreateur;

        return $this;
    }

    public function getPartieVictoire(): ?string
    {
        return $this->partieVictoire;
    }

    public function setPartieVictoire(string $partieVictoire): self
    {
        $this->partieVictoire = $partieVictoire;

        return $this;
    }

    /**
     * @return Collection<int, MotPartie>
     */
    public function getMotParties(): Collection
    {
        return $this->motParties;
    }

    public function addMotParty(MotPartie $motParty): self
    {
        if (!$this->motParties->contains($motParty)) {
            $this->motParties->add($motParty);
            $motParty->setPartie($this);
        }

        return $this;
    }

    public function removeMotParty(MotPartie $motParty): self
    {
        if ($this->motParties->removeElement($motParty)) {
            // set the owning side to null (unless already changed)
            if ($motParty->getPartie() === $this) {
                $motParty->setPartie(null);
            }
        }

        return $this;
    }
}
