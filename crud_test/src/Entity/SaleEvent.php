<?php

namespace App\Entity;

use App\Repository\SaleEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaleEventRepository::class)]
class SaleEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'SaleEvent', targetEntity: SaleEventEntry::class, orphanRemoval: true)]
    private Collection $saleEventEntries;

    public function __construct()
    {
        $this->saleEventEntries = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
            $saleEventEntry->setSaleEvent($this);
        }

        return $this;
    }

    public function removeSaleEventEntry(SaleEventEntry $saleEventEntry): self
    {
        if ($this->saleEventEntries->removeElement($saleEventEntry)) {
            // set the owning side to null (unless already changed)
            if ($saleEventEntry->getSaleEvent() === $this) {
                $saleEventEntry->setSaleEvent(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName() ." on ". $this->getDate()->format('Y-m-d');
    }


}
