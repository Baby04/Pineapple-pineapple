<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $orderdate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderDetail", mappedBy="Od", orphanRemoval=true)
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="order")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prod;

    /**
     * @ORM\Column(type="text")
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adressLine;

    /**
     * @ORM\Column(type="text")
     */
    private $city;

    /**
     * @ORM\Column(type="text")
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phonenumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $addDeliveryInstruction;

    /**
     * @ORM\Column(type="datetime")
     */
    private $orderedAt;

    /**
     * @ORM\PrePersist
     *
     * @return void
     */

    public function prePersist()
    {
        if (empty($this->Orderdate)) {
            $this->Orderdate = new \DateTime();
        }

        if (empty($this->OrderedAt)) {
            $this->OrderedAt = new \DateTime();
        }
    }
    

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderdate(): ?\DateTimeInterface
    {
        return $this->orderdate;
    }

    public function setOrderdate(\DateTimeInterface $orderdate): self
    {
        $this->orderdate = $orderdate;

        return $this;
    }

    /**
     * @return Collection|OrderDetail[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(OrderDetail $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setOd($this);
        }

        return $this;
    }

    public function removeOrder(OrderDetail $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getOd() === $this) {
                $order->setOd(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getProd(): ?Product
    {
        return $this->prod;
    }

    public function setProd(?Product $prod): self
    {
        $this->prod = $prod;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getAdressLine(): ?string
    {
        return $this->adressLine;
    }

    public function setAdressLine(string $adressLine): self
    {
        $this->adressLine = $adressLine;

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

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(?string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getAddDeliveryInstruction(): ?string
    {
        return $this->addDeliveryInstruction;
    }

    public function setAddDeliveryInstruction(?string $addDeliveryInstruction): self
    {
        $this->addDeliveryInstruction = $addDeliveryInstruction;

        return $this;
    }

    public function getOrderedAt(): ?\DateTimeInterface
    {
        return $this->orderedAt;
    }

    public function setOrderedAt(\DateTimeInterface $orderedAt): self
    {
        $this->orderedAt = $orderedAt;

        return $this;
    }
}