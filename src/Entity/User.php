<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     */
    private $nomComplet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proprietaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Image;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroCompte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $partenaire;





    
    

            public function getId(): ?int
            {
                return $this->id;
            }

            /**
             * A visual identifier that represents this user.
             *
             * @see UserInterface
             */
            public function getUsername(): string
            {
                return (string) $this->username;
            }

            public function setUsername(string $username): self
            {
                $this->username = $username;

                return $this;
            }

            /**
             * @see UserInterface
             */
            public function getRoles(): array
            {
                $role = $this->roles;
                // guarantee every user at least has ROLE_USER
                $role[] = 'ROLE_USER';

                return array_unique($role);
            }

            public function setRoles(array $roles): self
            {
                $this->roles = $roles;

                return $this;
            }

            /**
             * @see UserInterface
             */
            public function getPassword(): string
            {
                return (string) $this->password;
            }

            public function setPassword(string $password): self
            {
                $this->password = $password;

                return $this;
            }

            /**
             * @see UserInterface
             */
            public function getSalt()
            {
                // not needed when using the "bcrypt" algorithm in security.yaml
            }

            /**
             * @see UserInterface
             */
            public function eraseCredentials()
            {
            
            }

            public function getNomComplet(): ?string
            {
                return $this->nomComplet;
            }

            public function setNomComplet(string $nomComplet): self
            {
                $this->nomComplet = $nomComplet;

                return $this;
            }

            public function getStatus(): ?string
            {
                return $this->status;
            }

            public function setStatus(string $status): self
            {
                $this->status = $status;

                return $this;
            }

            public function getProprietaire(): ?string
            {
                return $this->proprietaire;
            }

            public function setProprietaire(string $proprietaire): self
            {
                $this->proprietaire = $proprietaire;

                return $this;
            }

            public function getImage(): ?string
            {
                return $this->Image;
            }

            public function setImage(?string $Image): self
            {
                $this->Image = $Image;

                return $this;
            }

            public function getNumeroCompte(): ?int
            {
                return $this->numeroCompte;
            }

            public function setNumeroCompte(?int $numeroCompte): self
            {
                $this->numeroCompte = $numeroCompte;

                return $this;
            }

            public function getPartenaire(): ?Partenaire
            {
                return $this->partenaire;
            }

            public function setPartenaire(?Partenaire $partenaire): self
            {
                $this->partenaire = $partenaire;

                return $this;
            }

        
        
      
        
}
