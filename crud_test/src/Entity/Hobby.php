<?php

namespace App\Entity;

use App\Repository\HobbyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HobbyRepository::class)]
class Hobby
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isIndoors = null;

    #[ORM\Column]
    private ?int $weeklyCost = null;

    #[ORM\ManyToOne(inversedBy: 'hobbies')]
    private ?Intensity $intensity = null;

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

    public function isIsIndoors(): ?bool
    {
        return $this->isIndoors;
    }

    public function setIsIndoors(bool $isIndoors): self
    {
        $this->isIndoors = $isIndoors;

        return $this;
    }

    public function getWeeklyCost(): ?int
    {
        return $this->weeklyCost;
    }

    public function setWeeklyCost(int $weeklyCost): self
    {
        $this->weeklyCost = $weeklyCost;

        return $this;
    }

    public function getIntensity(): ?Intensity
    {
        return $this->intensity;
    }

    public function setIntensity(?Intensity $intensity): self
    {
        $this->intensity = $intensity;

        return $this;
    }
}
