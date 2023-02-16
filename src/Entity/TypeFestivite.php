<?php

namespace App\Entity;

use App\Repository\TypeFestiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeFestiviteRepository::class)
 */
class TypeFestivite
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
    private $Festivite;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=Festivites::class, mappedBy="IdTypeFestivite")
     */
    private $festivites;

    /**
     * @ORM\OneToMany(targetEntity=Albums::class, mappedBy="IdTypeFest")
     */
    private $albums;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="idTypeFestivite")
     */
    private $videos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Statut;

    public function __construct()
    {
        $this->festivites = new ArrayCollection();
        $this->albums = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFestivite(): ?string
    {
        return $this->Festivite;
    }

    public function setFestivite(string $Festivite): self
    {
        $this->Festivite = $Festivite;

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
            $festivite->setIdTypeFestivite($this);
        }

        return $this;
    }

    public function removeFestivite(Festivites $festivite): self
    {
        if ($this->festivites->removeElement($festivite)) {
            // set the owning side to null (unless already changed)
            if ($festivite->getIdTypeFestivite() === $this) {
                $festivite->setIdTypeFestivite(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getFestivite();
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
            $album->setIdTypeFest($this);
        }

        return $this;
    }

    public function removeAlbum(Albums $album): self
    {
        if ($this->albums->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getIdTypeFest() === $this) {
                $album->setIdTypeFest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setIdTypeFestivite($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getIdTypeFestivite() === $this) {
                $video->setIdTypeFestivite(null);
            }
        }

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
}
