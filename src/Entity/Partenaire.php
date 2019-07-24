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
    private $Raison_social;

    /**
     * @ORM\Column(type="integer")
     */
    private $Ninea;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaisonSocial(): ?string
    {
        return $this->Raison_social;
    }

    public function setRaisonSocial(string $Raison_social): self
    {
        $this->Raison_social = $Raison_social;

        return $this;
    }

    public function getNinea(): ?int
    {
        return $this->Ninea;
    }

    public function setNinea(int $Ninea): self
    {
        $this->Ninea = $Ninea;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }
}
