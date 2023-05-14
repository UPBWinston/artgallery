<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\OneToMany(mappedBy: 'Artist', targetEntity: Art::class, orphanRemoval: true)]
    private Collection $Art;

    public function __construct()
    {
        $this->Art = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return Collection<int, Art>
     */
    public function getArt(): Collection
    {
        return $this->Art;
    }

    public function addArt(Art $art): self
    {
        if (!$this->Art->contains($art)) {
            $this->Art->add($art);
            $art->setArtist($this);
        }

        return $this;
    }

    public function removeArt(Art $art): self
    {
        if ($this->Art->removeElement($art)) {
            // set the owning side to null (unless already changed)
            if ($art->getArtist() === $this) {
                $art->setArtist(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getFirstName() . " " . $this->getSurname();
    }
}
