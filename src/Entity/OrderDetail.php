<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderDetailRepository")
 */
class OrderDetail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $totalprice;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $datePaid;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\order", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Od;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalprice(): ?float
    {
        return $this->totalprice;
    }

    public function setTotalprice(float $totalprice): self
    {
        $this->totalprice = $totalprice;

        return $this;
    }

    public function getDatePaid(): ?\DateTimeInterface
    {
        return $this->datePaid;
    }

    public function setDatePaid(\DateTimeInterface $datePaid): self
    {
        $this->datePaid = $datePaid;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOd(): ?order
    {
        return $this->Od;
    }

    public function setOd(?order $Od): self
    {
        $this->Od = $Od;

        return $this;
    }
}
