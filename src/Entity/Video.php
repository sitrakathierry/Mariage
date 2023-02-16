<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $lien;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=TypeFestivite::class, inversedBy="videos")
     */
    private $idTypeFestivite;

    /**
     * @ORM\ManyToOne(targetEntity=Mariage::class, inversedBy="videos")
     */
    private $idMariage;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=AttachementVideo::class, mappedBy="video", cascade={"persist"})
     */
    private $attachementVideos;

    public function __construct()
    {
        $this->attachementVideos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(?string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdTypeFestivite(): ?TypeFestivite
    {
        return $this->idTypeFestivite;
    }

    public function setIdTypeFestivite(?TypeFestivite $idTypeFestivite): self
    {
        $this->idTypeFestivite = $idTypeFestivite;

        return $this;
    }

    public function getIdMariage(): ?Mariage
    {
        return $this->idMariage;
    }

    public function setIdMariage(?Mariage $idMariage): self
    {
        $this->idMariage = $idMariage;

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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, AttachementVideo>
     */
    public function getAttachementVideos(): Collection
    {
        return $this->attachementVideos;
    }

    public function addAttachementVideo(AttachementVideo $attachementVideo): self
    {
        if (!$this->attachementVideos->contains($attachementVideo)) {
            $this->attachementVideos[] = $attachementVideo;
            $attachementVideo->setVideo($this);
        }

        return $this;
    }

    public function removeAttachementVideo(AttachementVideo $attachementVideo): self
    {
        if ($this->attachementVideos->removeElement($attachementVideo)) {
            // set the owning side to null (unless already changed)
            if ($attachementVideo->getVideo() === $this) {
                $attachementVideo->setVideo(null);
            }
        }

        return $this;
    }
}
