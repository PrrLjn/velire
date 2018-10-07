<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClusterRepository")
 */
class Cluster
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Luminaire", mappedBy="cluster")
     */
    private $luminaires;

    public function __construct()
    {
        $this->luminaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?int
    {
        return $this->label;
    }

    public function setLabel(int $label): self
    {
        $this->label = $label;

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

    /**
     * @return Collection|Luminaire[]
     */
    public function getLuminaires(): Collection
    {
        return $this->luminaires;
    }

    public function addLuminaire(Luminaire $luminaire): self
    {
        if (!$this->luminaires->contains($luminaire)) {
            $this->luminaires[] = $luminaire;
            $luminaire->setCluster($this);
        }

        return $this;
    }

    public function removeLuminaire(Luminaire $luminaire): self
    {
        if ($this->luminaires->contains($luminaire)) {
            $this->luminaires->removeElement($luminaire);
            // set the owning side to null (unless already changed)
            if ($luminaire->getCluster() === $this) {
                $luminaire->setCluster(null);
            }
        }

        return $this;
    }
}