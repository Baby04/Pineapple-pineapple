<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupplierRepository")
 */
class Supplier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $addresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Supplies", mappedBy="supplier", orphanRemoval=true)
     */
    private $supply;

    public function __construct()
    {
        $this->supply = new ArrayCollection();
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
     * @return Collection|Supplies[]
     */
    public function getSupply(): Collection
    {
        return $this->supply;
    }

    public function addSupply(Supplies $supply): self
    {
        if (!$this->supply->contains($supply)) {
            $this->supply[] = $supply;
            $supply->setSupplier($this);
        }

        return $this;
    }

    public function removeSupply(Supplies $supply): self
    {
        if ($this->supply->contains($supply)) {
            $this->supply->removeElement($supply);
            // set the owning side to null (unless already changed)
            if ($supply->getSupplier() === $this) {
                $supply->setSupplier(null);
            }
        }

        return $this;
    }
}
