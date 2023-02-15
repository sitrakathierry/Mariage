<?php

namespace App\Entity;

use App\Repository\ActualitesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ActualitesRepository::class)
 * @Vich\Uploadable
 */
class Actualites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $Titre;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Statut;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Explication;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $Auteur;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="actualities")
     */
    private $IdUser;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ImageActualite;

    /** 
     * @Vich\UploadableField(mapping="map_albums" , fileNameProperty="ImageActualite")
     * @var File
     */
    private $actualitesFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

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

    public function getStatut(): ?int
    {
        return $this->Statut;
    }

    public function setStatut(?int $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getExplication(): ?string
    {
        return $this->Explication;
    }

    public function setExplication(?string $Explication): self
    {
        $this->Explication = $Explication;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(?string $Auteur): self
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->IdUser;
    }

    public function setIdUser(?User $IdUser): self
    {
        $this->IdUser = $IdUser;

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

    public function getImageActualite(): ?string
    {
        return $this->ImageActualite;
    }

    public function setImageActualite(?string $ImageActualite): self
    {
        $this->ImageActualite = $ImageActualite;

        return $this;
    }

    /** 
     * @return File|null
     */
    public function getActualitesFile(): ?File
    {
        return $this->actualitesFile;
    }

    
    /** 
     * @param File|null $actualitesFile
     */
    public function setActualitesFile(?File $actualitesFile)
    {
        $this->actualitesFile = $actualitesFile;

        if (null !== $actualitesFile) {
            $this->updated_at = new \DateTimeImmutable;
        }
    }

}
