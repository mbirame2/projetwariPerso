<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
}
