<?php

namespace App\Entity;

use App\Repository\GCPRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GCPRepository::class)]
class GCP
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $share = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pricingmodel = null;

    #[ORM\Column(nullable: true)]
    private ?int $datacenter = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShare(): ?int
    {
        return $this->share;
    }

    public function setShare(?int $share): static
    {
        $this->share = $share;

        return $this;
    }

    public function getPricingmodel(): ?string
    {
        return $this->pricingmodel;
    }

    public function setPricingmodel(?string $pricingmodel): static
    {
        $this->pricingmodel = $pricingmodel;

        return $this;
    }

    public function getDatacenter(): ?int
    {
        return $this->datacenter;
    }

    public function setDatacenter(?int $datacenter): static
    {
        $this->datacenter = $datacenter;

        return $this;
    }
}
