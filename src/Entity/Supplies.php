<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuppliesRepository")
 */
class Supplies
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $resourceType;

    /**
     * @ORM\Column(type="integer")
     */
    private $resourceQuantity;

    /**
     * @ORM\Column(type="float")
     */
    private $resourcePrice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\supplier", inversedBy="supply")
     * @ORM\JoinColumn(nullable=false)
     */
    private $supplier;

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

    public function getResourceType(): ?string
    {
        return $this->resourceType;
    }

    public function setResourceType(string $resourceType): self
    {
        $this->resourceType = $resourceType;

        return $this;
    }

    public function getResourceQuantity(): ?int
    {
        return $this->resourceQuantity;
    }

    public function setResourceQuantity(int $resourceQuantity): self
    {
        $this->resourceQuantity = $resourceQuantity;

        return $this;
    }

    public function getResourcePrice(): ?float
    {
        return $this->resourcePrice;
    }

    public function setResourcePrice(float $resourcePrice): self
    {
        $this->resourcePrice = $resourcePrice;

        return $this;
    }

    public function getSupplier(): ?supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }
}
