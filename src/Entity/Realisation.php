<?php

namespace App\Entity;

use App\Repository\RealisationRepository;
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
 * @ORM\Entity(repositoryClass=RealisationRepository::class)
 * @Vich\Uploadable
 * @UniqueEntity(
 *    fields={"name"},
 *    message="Le projet existe déjà'"
 * )
 */
class Realisation
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $realisationphoto = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $projectlink;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, inversedBy="realisations")
     */
    private $competences;

    /**
     * @Vich\UploadableField(mapping="realisationphoto_file", fileNameProperty="realisationphoto")
     * @var File
     * @Assert\File(maxSize="1000k", mimeTypes={"image/jpeg", "image/png"})
     */

    private ?File $realisationphotoFile = null;



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
        $this->competences = new ArrayCollection();
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

    public function getRealisationphoto(): ?string
    {
        return $this->realisationphoto;
    }

    public function setRealisationphoto(?string $realisationphoto): self
    {
        $this->realisationphoto = $realisationphoto;

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

    public function getProjectlink(): ?string
    {
        return $this->projectlink;
    }

    public function setProjectlink(?string $projectlink): self
    {
        $this->projectlink = $projectlink;

        return $this;
    }

    /**
     * @return Collection|competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(competence $competence): self
    {
        $this->competences->removeElement($competence);

        return $this;
    }

    public function setRealisationphotoFile(?File $realisationphotoFile = null): void

    {
        $this->realisationphotoFile = $realisationphotoFile;
        if (null !== $realisationphotoFile) {
            $this->uploadedAt = new DateTimeImmutable('now');
        }
    }

    public function getRealisationphotoFile(): ?File
    {
        return $this->realisationphotoFile;
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
