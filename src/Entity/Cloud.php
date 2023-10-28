<?php

namespace App\Entity;

use App\Repository\CloudRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CloudRepository::class)]
class Cloud
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $share = null;

    #[ORM\Column]
    private ?int $launch = null;

    #[ORM\Column(length: 255)]
    private ?string $owner = null;

    #[ORM\Column]
    private ?int $revenue = null;

    #[ORM\Column(nullable: true)]
    private ?int $pricing = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $storage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $api = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShare(): ?int
    {
        return $this->share;
    }

    public function setShare(int $share): static
    {
        $this->share = $share;

        return $this;
    }

    public function getLaunch(): ?int
    {
        return $this->launch;
    }

    public function setLaunch(int $launch): static
    {
        $this->launch = $launch;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getRevenue(): ?int
    {
        return $this->revenue;
    }

    public function setRevenue(int $revenue): static
    {
        $this->revenue = $revenue;

        return $this;
    }

    public function getPricing(): ?int
    {
        return $this->pricing;
    }

    public function setPricing(?int $pricing): static
    {
        $this->pricing = $pricing;

        return $this;
    }

    public function getStorage(): ?string
    {
        return $this->storage;
    }

    public function setStorage(?string $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function getVn(): ?string
    {
        return $this->vn;
    }

    public function setVn(?string $vn): static
    {
        $this->vn = $vn;

        return $this;
    }

    public function getApi(): ?string
    {
        return $this->api;
    }

    public function setApi(?string $api): static
    {
        $this->api = $api;

        return $this;
    }
}
