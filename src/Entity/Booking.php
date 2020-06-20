<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datebooked;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deliverydate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatebooked(): ?\DateTimeInterface
    {
        return $this->datebooked;
    }

    public function setDatebooked(?\DateTimeInterface $datebooked): self
    {
        $this->datebooked = $datebooked;

        return $this;
    }

    public function getDeliverydate(): ?\DateTimeInterface
    {
        return $this->deliverydate;
    }

    public function setDeliverydate(?\DateTimeInterface $deliverydate): self
    {
        $this->deliverydate = $deliverydate;

        return $this;
    }
}
