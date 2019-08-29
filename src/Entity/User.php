<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File; 
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 * @Vich\Uploadable 
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="imageName")
     * @ORM\JoinColumn(nullable=true)
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255 )
     * @ORM\JoinColumn(nullable=true)
     * @var string
     */
    private $imageName;

  

    /**
     * @ORM\Column(type="string", length=180)
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroCompte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $partenaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EnvoiArgent", mappedBy="user")
     */
    private $envoiArgents;

    public function __construct()
    {
        $this->envoiArgents = new ArrayCollection();
    }




    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    



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

            public function setUsername(?string $username): self
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

            /**
             * @return Collection|EnvoiArgent[]
             */
            public function getEnvoiArgents(): Collection
            {
                return $this->envoiArgents;
            }

            public function addEnvoiArgent(EnvoiArgent $envoiArgent): self
            {
                if (!$this->envoiArgents->contains($envoiArgent)) {
                    $this->envoiArgents[] = $envoiArgent;
                    $envoiArgent->setUser($this);
                }

                return $this;
            }

            public function removeEnvoiArgent(EnvoiArgent $envoiArgent): self
            {
                if ($this->envoiArgents->contains($envoiArgent)) {
                    $this->envoiArgents->removeElement($envoiArgent);
                    // set the owning side to null (unless already changed)
                    if ($envoiArgent->getUser() === $this) {
                        $envoiArgent->setUser(null);
                    }
                }

                return $this;
            }

        
        
      
        
}
