<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\VersementRepository")
 */
class Versement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThan(75000)
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateVersement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caissier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="versements")
     */
    private $compte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateVersement(): ?\DateTimeInterface
    {
        return $this->dateVersement;
    }

    public function setDateVersement(\DateTimeInterface $dateVersement): self
    {
        $this->dateVersement = $dateVersement;

        return $this;
    }

    public function getCaissier(): ?string
    {
        return $this->caissier;
    }

    public function setCaissier(string $caissier): self
    {
        $this->caissier = $caissier;

        return $this;
    }


    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('montant', new Assert\GreaterThan(75000));

       
    }
}
