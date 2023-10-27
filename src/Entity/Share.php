<?php

namespace App\Entity;

use App\Repository\ShareRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShareRepository::class)]
class Share
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $aws = null;

    #[ORM\Column]
    private ?int $azure = null;

    #[ORM\Column]
    private ?int $gcp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAws(): ?int
    {
        return $this->aws;
    }

    public function setAws(int $aws): static
    {
        $this->aws = $aws;

        return $this;
    }

    public function getAzure(): ?int
    {
        return $this->azure;
    }

    public function setAzure(int $azure): static
    {
        $this->azure = $azure;

        return $this;
    }

    public function getGcp(): ?int
    {
        return $this->gcp;
    }

    public function setGcp(int $gcp): static
    {
        $this->gcp = $gcp;

        return $this;
    }
}
