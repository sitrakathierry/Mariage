<?php

namespace App\Entity;

use App\Repository\MariageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MariageRepository::class)
 */
class Mariage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomHomme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomFemme;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Statut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $PhotoMariee;

    /**
     * @ORM\OneToMany(targetEntity=Festivites::class, mappedBy="id_mariage")
     */
    private $festivites;

    /**
     * @ORM\OneToMany(targetEntity=Albums::class, mappedBy="IdMariage")
     */
    private $albums;

    public function __construct()
    {
        $this->festivites = new ArrayCollection();
        $this->albums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomHomme(): ?string
    {
        return $this->NomHomme;
    }

    public function setNomHomme(string $NomHomme): self
    {
        $this->NomHomme = $NomHomme;

        return $this;
    }

    public function getNomFemme(): ?string
    {
        return $this->NomFemme;
    }

    public function setNomFemme(string $NomFemme): self
    {
        $this->NomFemme = $NomFemme;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getPhotoMariee(): ?string
    {
        return $this->PhotoMariee;
    }

    public function setPhotoMariee(string $PhotoMariee): self
    {
        $this->PhotoMariee = $PhotoMariee;

        return $this;
    }

    /**
     * @return Collection<int, Festivites>
     */
    public function getFestivites(): Collection
    {
        return $this->festivites;
    }

    public function addFestivite(Festivites $festivite): self
    {
        if (!$this->festivites->contains($festivite)) {
            $this->festivites[] = $festivite;
            $festivite->setIdMariage($this);
        }

        return $this;
    }

    public function removeFestivite(Festivites $festivite): self
    {
        if ($this->festivites->removeElement($festivite)) {
            // set the owning side to null (unless already changed)
            if ($festivite->getIdMariage() === $this) {
                $festivite->setIdMariage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Albums>
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Albums $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setIdMariage($this);
        }

        return $this;
    }

    public function removeAlbum(Albums $album): self
    {
        if ($this->albums->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getIdMariage() === $this) {
                $album->setIdMariage(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getId() . ' - ' . $this->getNomHomme() . ' & ' . $this->getNomFemme();
    }
}
