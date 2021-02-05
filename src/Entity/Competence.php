<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use DateTime;
use DateTimeInterface;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 * @Vich\Uploadable
 * @UniqueEntity(
 *    fields={"name"},
 *    message="La compétence existe déjà'"
 * )
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private ?string $photocomp = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Realisation::class, mappedBy="competences")
     */
    private $realisations;


    /**
     * @Vich\UploadableField(mapping="photocomp_file", fileNameProperty="photocomp")
     * @var File
     * @Assert\File(maxSize="1000k", mimeTypes={"image/jpeg", "image/png"})
     */

    private ?File $photocompFile= null;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTimeInterface
     */

    private ?\DateTimeInterface $uploadedAt ;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priority;


    public function __construct()
    {
        $this->realisations = new ArrayCollection();
        $this->uploadedAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhotocomp(): ?string
    {
        return $this->photocomp;
    }

    public function setPhotocomp(?string $photocomp): self
    {
        $this->photocomp = $photocomp;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Realisation[]
     */
    public function getRealisations(): Collection
    {
        return $this->realisations;
    }

    public function addRealisation(Realisation $realisation): self
    {
        if (!$this->realisations->contains($realisation)) {
            $this->realisations[] = $realisation;
            $realisation->addCompetence($this);
        }

        return $this;
    }

    public function removeRealisation(Realisation $realisation): self
    {
        if ($this->realisations->removeElement($realisation)) {
            $realisation->removeCompetence($this);
        }

        return $this;
    }

    public function setPhotocompFile(?File $photocompFile = null): void

    {
        $this->photocompFile = $photocompFile;
        if (null !== $photocompFile) {
            $this->uploadedAt = new DateTimeImmutable('now');
        }
    }


    public function getPhotocompFile(): ?File
    {
        return $this->photocompFile;
    }

    public function getUploadedAt(): ?\DateTimeInterface
    {
        return $this->uploadedAt;
    }

    public function setUploadedAt(?\DateTimeInterface $uploadedAt): self
    {
        $this->uploadedAt = $uploadedAt;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
}
