<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TarifRepository")
 */
class Tarif
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $BorneInferieur;

    /**
     * @ORM\Column(type="bigint")
     */
    private $BorneSuperieur;

    /**
     * @ORM\Column(type="bigint")
     */
    private $Valeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorneInferieur(): ?int
    {
        return $this->BorneInferieur;
    }

    public function setBorneInferieur(int $BorneInferieur): self
    {
        $this->BorneInferieur = $BorneInferieur;

        return $this;
    }

    public function getBorneSuperieur(): ?int
    {
        return $this->BorneSuperieur;
    }

    public function setBorneSuperieur(int $BorneSuperieur): self
    {
        $this->BorneSuperieur = $BorneSuperieur;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->Valeur;
    }

    public function setValeur(int $Valeur): self
    {
        $this->Valeur = $Valeur;

        return $this;
    }
}
