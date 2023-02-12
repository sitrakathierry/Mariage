<?php

namespace App\Entity;

use App\Repository\AlbumsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AlbumsRepository::class)
 * @Vich\Uploadable
 */
class Albums
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
    private $Nom;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=500,  nullable=true)
     */
    private $Chemin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

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

    private $IdFest;

    /**
     * @ORM\ManyToOne(targetEntity=Festivites::class, inversedBy="albumsa")
     */
    private $id_fest;

    /**
     * @ORM\ManyToOne(targetEntity=Mariage::class, inversedBy="albums")
     */
    private $IdMariage;

    /** 
     * @Vich\UploadableField(mapping="map_albums" , fileNameProperty="Nom")
     * @var File
     */
    private $albumFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

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

    public function getChemin(): ?string
    {
        return $this->Chemin;
    }

    public function setChemin(string $Chemin): self
    {
        $this->Chemin = $Chemin;

        return $this;
    }
    /** 
     * @return File|null
     */
    public function getAlbumFile(): ?File
    {
        return $this->albumFile ;
    }

    /** 
     * @param File|null $AlbumFile
     */
    public function setAlbumFile(File $AlbumFile)
    {
        $this->albumFile = $AlbumFile;

        if (null !== $AlbumFile) {
            $this->updated_at = new \DateTimeImmutable;
        }
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

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

    public function getIdFest(): ?Festivites
    {
        return $this->id_fest;
    }

    public function setIdFest(?Festivites $id_fest): self
    {
        $this->id_fest = $id_fest;

        return $this;
    }

    public function getIdMariage(): ?Mariage
    {
        return $this->IdMariage;
    }

    public function setIdMariage(?Mariage $IdMariage): self
    {
        $this->IdMariage = $IdMariage;

        return $this;
    }
}
