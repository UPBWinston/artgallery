<?php

namespace App\Entity;

use App\Repository\SaleEventEntryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaleEventEntryRepository::class)]
class SaleEventEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'saleEventEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SaleEvent $SaleEvent = null;

    #[ORM\ManyToOne(inversedBy: 'saleEventEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Art $Art = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaleEvent(): ?SaleEvent
    {
        return $this->SaleEvent;
    }

    public function setSaleEvent(?SaleEvent $SaleEvent): self
    {
        $this->SaleEvent = $SaleEvent;

        return $this;
    }

    public function getArt(): ?Art
    {
        return $this->Art;
    }

    public function setArt(?Art $Art): self
    {
        $this->Art = $Art;

        return $this;
    }
}
