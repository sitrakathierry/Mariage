<?php

namespace App\Entity;

use App\Repository\FestivitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FestivitesRepository::class)
 */
class Festivites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Mariage::class, inversedBy="festivites")
     */
    private $IdMariage;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $Lieu;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $Ville;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $NomFest;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $Heure;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Statut;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=TypeFestivite::class, inversedBy="festivites")
     */
    private $IdTypeFestivite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMariage(): ?Mariage
    {
        return $this->IdMariage;
    }

    public function setIdMariage(Mariage $IdMariage): self
    {
        $this->IdMariage = $IdMariage;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->Lieu;
    }

    public function setLieu(?string $Lieu): self
    {
        $this->Lieu = $Lieu;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(?string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getNomFest(): ?string
    {
        return $this->NomFest;
    }

    public function setNomFest(string $NomFest): self
    {
        $this->NomFest = $NomFest;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->Heure;
    }

    public function setHeure(?\DateTimeInterface $Heure): self
    {
        $this->Heure = $Heure;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->Statut;
    }

    public function setStatut(?int $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function __toString()
    {
        return $this->getNomFest();
    }

    public function getIdTypeFestivite(): ?TypeFestivite
    {
        return $this->IdTypeFestivite;
    }

    public function setIdTypeFestivite(?TypeFestivite $IdTypeFestivite): self
    {
        $this->IdTypeFestivite = $IdTypeFestivite;

        return $this;
    }

}
