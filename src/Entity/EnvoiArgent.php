<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnvoiArgentRepository")
 */
class EnvoiArgent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $montantaverser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="envoiArgents")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomcomplet;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $pieceid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedelivrance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomcompletReceveur;

    /**
     * @ORM\Column(type="integer")
     */
    private $pieceidReceveur;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeTransfert;

    /**
     * @ORM\Column(type="integer")
     */
    private $envoitarif;

    /**
     * @ORM\Column(type="integer")
     */
    private $receveurtarif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantaverser(): ?int
    {
        return $this->montantaverser;
    }

    public function setMontantaverser(int $montantaverser): self
    {
        $this->montantaverser = $montantaverser;

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

    public function getNomcomplet(): ?string
    {
        return $this->nomcomplet;
    }

    public function setNomcomplet(string $nomcomplet): self
    {
        $this->nomcomplet = $nomcomplet;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPieceid(): ?int
    {
        return $this->pieceid;
    }

    public function setPieceid(int $pieceid): self
    {
        $this->pieceid = $pieceid;

        return $this;
    }

    public function getDatedelivrance(): ?\DateTimeInterface
    {
        return $this->datedelivrance;
    }

    public function setDatedelivrance(\DateTimeInterface $datedelivrance): self
    {
        $this->datedelivrance = $datedelivrance;

        return $this;
    }

    public function getNomcompletReceveur(): ?string
    {
        return $this->nomcompletReceveur;
    }

    public function setNomcompletReceveur(string $nomcompletReceveur): self
    {
        $this->nomcompletReceveur = $nomcompletReceveur;

        return $this;
    }

    public function getPieceidReceveur(): ?int
    {
        return $this->pieceidReceveur;
    }

    public function setPieceidReceveur(int $pieceidReceveur): self
    {
        $this->pieceidReceveur = $pieceidReceveur;

        return $this;
    }

    public function getCodeTransfert(): ?int
    {
        return $this->codeTransfert;
    }

    public function setCodeTransfert(int $codeTransfert): self
    {
        $this->codeTransfert = $codeTransfert;

        return $this;
    }

    public function getEnvoitarif(): ?int
    {
        return $this->envoitarif;
    }

    public function setEnvoitarif(int $envoitarif): self
    {
        $this->envoitarif = $envoitarif;

        return $this;
    }

    public function getReceveurtarif(): ?int
    {
        return $this->receveurtarif;
    }

    public function setReceveurtarif(int $receveurtarif): self
    {
        $this->receveurtarif = $receveurtarif;

        return $this;
    }
}
