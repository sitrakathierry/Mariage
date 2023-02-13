<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Panier::class, inversedBy="articles")
     */
    private $IdPanier;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="articles")
     */
    private $IdCategorie;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPanier(): ?Panier
    {
        return $this->IdPanier;
    }

    public function setIdPanier(Panier $IdPanier): self
    {
        $this->IdPanier = $IdPanier;

        return $this;
    }

    public function getIdCategorie(): ?Categories
    {
        return $this->IdCategorie;
    }

    public function setIdCategorie(Categories $IdCategorie): self
    {
        if ($this->getIdCategorie() !== $IdCategorie) {
            $this->IdCategorie = $IdCategorie;
            $this->setUpdatedAt(new \DateTimeImmutable);
        }
       
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
}
