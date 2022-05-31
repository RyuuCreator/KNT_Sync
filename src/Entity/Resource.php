<?php

namespace App\Entity;

use App\Repository\ResourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResourceRepository::class)]
class Resource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $artistname;

    #[ORM\Column(type: 'string', length: 255)]
    private $trackname;

    #[ORM\Column(type: 'string', length: 255)]
    private $cover;

    #[ORM\Column(type: 'string', length: 255)]
    private $audio;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'resources')]
    private $category;

    #[ORM\ManyToMany(targetEntity: Ambiance::class, inversedBy: 'resources')]
    private $ambiance;

    #[Gedmo\Slug(fields: ['artistname, trackname'])]
    #[ORM\Column(type: 'string', length: 128, unique: true)]
    private $slug;

    public function __construct()
    {
        $this->ambiance = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtistname(): ?string
    {
        return $this->artistname;
    }

    public function setArtistname(string $artistname): self
    {
        $this->artistname = $artistname;

        return $this;
    }

    public function getTrackname(): ?string
    {
        return $this->trackname;
    }

    public function setTrackname(string $trackname): self
    {
        $this->trackname = $trackname;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getAudio(): ?string
    {
        return $this->audio;
    }

    public function setAudio(string $audio): self
    {
        $this->audio = $audio;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Ambiance>
     */
    public function getAmbiance(): Collection
    {
        return $this->ambiance;
    }

    public function addAmbiance(Ambiance $ambiance): self
    {
        if (!$this->ambiance->contains($ambiance)) {
            $this->ambiance[] = $ambiance;
        }

        return $this;
    }

    public function removeAmbiance(Ambiance $ambiance): self
    {
        $this->ambiance->removeElement($ambiance);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
