<?php

namespace App\Entity;

use App\Repository\ArtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtRepository::class)]
class Art
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'Art')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $Artist = null;

    #[ORM\Column]
    private ?bool $isAvailable = null;

    #[ORM\OneToMany(mappedBy: 'Art', targetEntity: SaleEventEntry::class, orphanRemoval: true)]
    private Collection $saleEventEntries;

    public function __construct()
    {
        $this->saleEventEntries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->Artist;
    }

    public function setArtist(?Artist $Artist): self
    {
        $this->Artist = $Artist;

        return $this;
    }

    public function isIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * @return Collection<int, SaleEventEntry>
     */
    public function getSaleEventEntries(): Collection
    {
        return $this->saleEventEntries;
    }

    public function addSaleEventEntry(SaleEventEntry $saleEventEntry): self
    {
        if (!$this->saleEventEntries->contains($saleEventEntry)) {
            $this->saleEventEntries->add($saleEventEntry);
            $saleEventEntry->setArt($this);
        }

        return $this;
    }

    public function removeSaleEventEntry(SaleEventEntry $saleEventEntry): self
    {
        if ($this->saleEventEntries->removeElement($saleEventEntry)) {
            // set the owning side to null (unless already changed)
            if ($saleEventEntry->getArt() === $this) {
                $saleEventEntry->setArt(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return "\"".$this->getTitle() ."\" by ". $this->getArtist();
    }
}
