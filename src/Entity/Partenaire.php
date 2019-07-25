<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $raisonSocial;

    /**
     * @ORM\Column(type="integer")
     */
    private $ninea;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="bigint")
     */
    private $numeroCompte;

    /**
     * @ORM\Column(type="bigint")
     */
    private $solde;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Versement", mappedBy="partenaire")
     */
    private $versements;

    public function __construct()
    {
        $this->versements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaisonSocial(): ?string
    {
        return $this->raisonSocial;
    }

    public function setRaisonSocial(string $Raison_social): self
    {
        $this->raisonSocial = $Raison_social;

        return $this;
    }

    public function getNinea(): ?int
    {
        return $this->ninea;
    }

    public function setNinea(int $Ninea): self
    {
        $this->ninea = $Ninea;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->adresse = $Adresse;

        return $this;
    }

    public function getNumeroCompte(): ?int
    {
        return $this->numeroCompte;
    }

    public function setNumeroCompte(int $numeroCompte): self
    {
        $this->numeroCompte = $numeroCompte;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * @return Collection|Versement[]
     */
    public function getVersements(): Collection
    {
        return $this->versements;
    }

    public function addVersement(Versement $versement): self
    {
        if (!$this->versements->contains($versement)) {
            $this->versements[] = $versement;
            $versement->setPartenaire($this);
        }

        return $this;
    }

    public function removeVersement(Versement $versement): self
    {
        if ($this->versements->contains($versement)) {
            $this->versements->removeElement($versement);
            // set the owning side to null (unless already changed)
            if ($versement->getPartenaire() === $this) {
                $versement->setPartenaire(null);
            }
        }

        return $this;
    }
}
