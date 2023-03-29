<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $utilisateur_id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $utilisateur_email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $utilisateur_created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisateur_pseudo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tokenRegistration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $tokenRegistrationLifeTime = null;

    #[ORM\Column]
    private bool $isVerified = false;

    #[ORM\Column(length: 255)]
    private ?string $avatar = null;


    public function __construct()
    {
        $this->utilisateur_created_at = $utilisateur_created_at ?? new \DateTimeImmutable();
        $this->isVerified = false;
        $this->tokenRegistrationLifeTime = (new \DateTime('now'))->add(new \DateInterval('P1D'));
    }



    public function getUtilisateurId(): ?int
    {
        return $this->utilisateur_id;
    }

    public function getUtilisateurEmail(): ?string
    {
        return $this->utilisateur_email;
    }

    public function setUtilisateurEmail(string $utilisateur_email): self
    {
        $this->utilisateur_email = $utilisateur_email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->utilisateur_email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUtilisateurCreatedAt(): ?\DateTimeImmutable
    {
        return $this->utilisateur_created_at;
    }

    public function setUtilisateurCreatedAt(\DateTimeImmutable $utilisateur_created_at): self
    {
        $this->utilisateur_created_at = $utilisateur_created_at;

        return $this;
    }

    public function getUtilisateurPseudo(): ?string
    {
        return $this->utilisateur_pseudo;
    }

    public function setUtilisateurPseudo(string $utilisateur_pseudo): self
    {
        $this->utilisateur_pseudo = $utilisateur_pseudo;

        return $this;
    }

    public function getTokenRegistration(): ?string
    {
        return $this->tokenRegistration;
    }

    public function setTokenRegistration(?string $tokenRegistration): self
    {
        $this->tokenRegistration = $tokenRegistration;

        return $this;
    }

    public function getTokenRegistrationLifeTime(): ?\DateTimeInterface
    {
        return $this->tokenRegistrationLifeTime;
    }

    public function setTokenRegistrationLifeTime(\DateTimeInterface $tokenRegistrationLifeTime): self
    {
        $this->tokenRegistrationLifeTime = $tokenRegistrationLifeTime;

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
