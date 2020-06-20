<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlantationRepository")
 */
class Plantation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="text")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="plantation", orphanRemoval=true)
     */
    private $plantation;

    public function __construct()
    {
        $this->plantation = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getPlantation(): Collection
    {
        return $this->plantation;
    }

    public function addPlantation(Product $plantation): self
    {
        if (!$this->plantation->contains($plantation)) {
            $this->plantation[] = $plantation;
            $plantation->setPlantation($this);
        }

        return $this;
    }

    public function removePlantation(Product $plantation): self
    {
        if ($this->plantation->contains($plantation)) {
            $this->plantation->removeElement($plantation);
            // set the owning side to null (unless already changed)
            if ($plantation->getPlantation() === $this) {
                $plantation->setPlantation(null);
            }
        }

        return $this;
    }
}
