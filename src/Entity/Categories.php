<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
    private $DateEnr;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdTypeOffre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Statut;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $Image;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdPrix;

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

    public function getDateEnr(): ?\DateTimeInterface
    {
        return $this->DateEnr;
    }

    public function setDateEnr(\DateTimeInterface $DateEnr): self
    {
        $this->DateEnr = $DateEnr;

        return $this;
    }

    public function getIdTypeOffre(): ?int
    {
        return $this->IdTypeOffre;
    }

    public function setIdTypeOffre(int $IdTypeOffre): self
    {
        $this->IdTypeOffre = $IdTypeOffre;

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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

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

    public function getIdPrix(): ?int
    {
        return $this->IdPrix;
    }

    public function setIdPrix(int $IdPrix): self
    {
        $this->IdPrix = $IdPrix;

        return $this;
    }
}
