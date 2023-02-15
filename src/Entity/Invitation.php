<?php

namespace App\Entity;

use App\Repository\InvitationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=InvitationRepository::class)
 * @Vich\Uploadable
 */
class Invitation
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
    private $nomMariees;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $motInvitation;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $PhotoMariee;

    /** 
     * @Vich\UploadableField(mapping="map_albums" , fileNameProperty="PhotoMariee")
     * @var File
     */
    private $invitationFile;

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

    public function getNomMariees(): ?string
    {
        return $this->nomMariees;
    }

    public function setNomMariees(string $nomMariees): self
    {
        $this->nomMariees = $nomMariees;

        return $this;
    }

    public function getMotInvitation(): ?string
    {
        return $this->motInvitation;
    }

    public function setMotInvitation(?string $motInvitation): self
    {
        $this->motInvitation = $motInvitation;

        return $this;
    }

    public function getPhotoMariee(): ?string
    {
        return $this->PhotoMariee;
    }

    public function setPhotoMariee(?string $PhotoMariee): self
    {
        $this->PhotoMariee = $PhotoMariee;

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
     * @return File|null
     */
    public function getInvitationFile(): ?File
    {
        return $this->invitationFile;
    }

    /** 
     * @param File|null $invitationFile
     */
    public function setInvitationFile(?File $invitationFile)
    {
        $this->invitationFile = $invitationFile;

        if (null !== $invitationFile) {
            $this->updated_at = new \DateTimeImmutable;
        }
    }
}
