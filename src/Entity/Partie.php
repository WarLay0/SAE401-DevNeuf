<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PartieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
#[ApiResource()]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $partieEtat = null;

    #[ORM\Column]
    private ?int $partieNBTour = null;

    #[ORM\Column(length: 255)]
    private ?string $partieJoueurTour = null;

    #[ORM\Column(length: 255)]
    private ?string $partieVictoire = null;

    #[ORM\OneToMany(mappedBy: 'partie', targetEntity: MotPartie::class)]
    private Collection $motParties;


    #[ORM\JoinColumn(name: "id", referencedColumnName: "id", nullable: true)]
    #[ORM\JoinTable(name: "partie_utilisateur")]
    #[ORM\InverseJoinColumn(name: "utilisateur_id", referencedColumnName: "utilisateur_id", nullable: true)]
    #[ORM\ManyToMany(targetEntity: Utilisateur::class, inversedBy: 'parties')]
    private Collection $joueur;

    #[ORM\Column(length: 255)]
    private ?string $nomPartie = null;

    #[ORM\Column]
    private ?bool $partie_type = null;

    public function __construct()
    {
        $this->motParties = new ArrayCollection();
        $this->joueur = new ArrayCollection();
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

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getJoueur(): Collection
    {
        return $this->joueur;
    }

    public function addJoueur(Utilisateur $joueur): self
    {
        if (!$this->joueur->contains($joueur)) {
            $this->joueur->add($joueur);
        }

        return $this;
    }

    public function removeJoueur(Utilisateur $joueur): self
    {
        $this->joueur->removeElement($joueur);

        return $this;
    }

    public function getNomPartie(): ?string
    {
        return $this->nomPartie;
    }

    public function setNomPartie(string $nomPartie): self
    {
        $this->nomPartie = $nomPartie;

        return $this;
    }

    public function isPartieType(): ?bool
    {
        return $this->partie_type;
    }

    public function setPartieType(bool $partie_type): self
    {
        $this->partie_type = $partie_type;

        return $this;
    }

}
