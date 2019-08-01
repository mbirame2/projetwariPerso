<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\Column(type="bigint")
     * @Assert\Positive
     * @Assert\GreaterThan(
     *     value = 75000
     * )
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partenaire", inversedBy="versements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partenaire;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateVersement;

    /**
     * @ORM\Column(type="integer")
     */
    private $caissier;



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

    public function getPartenaire(): ?Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire(?Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

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

    public function getCaissier(): ?int
    {
        return $this->caissier;
    }

    public function setCaissier(int $caissier): self
    {
        $this->caissier = $caissier;

        return $this;
    }
}
