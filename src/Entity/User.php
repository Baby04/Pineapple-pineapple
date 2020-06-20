<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @uniqueEntity(
 *  fields={"email"},
 *  message="This email is used by another user, choose or modify the email"
 * )
 */

class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Fill in your surname")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Fill in your family name" )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Please input a valid email!")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(message="Input a valide url for your avatar")
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Your password must be of 8 characters")
     */
    private $hash;

    /**
     * @Assert\EqualTo(propertyPath="hash", message="Your password does not match")
     */
    public $passwordConfirm;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="owner", orphanRemoval=true)
     */
    private $order;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="users")
     */
    private $userRoles;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $reset_token;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $Roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="author", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cart", mappedBy="user", cascade={"persist", "remove"})
     */
    private $cart;

    public function __construct()
    {
        $this->order = new ArrayCollection();
        $this->userRole = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrder(): Collection
    {
        return $this->order;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->order->contains($order)) {
            $this->order[] = $order;
            $order->setOwner($this);
        }

        return $this;
    }

    public function removeCustomer(Order $order): self
    {
        if ($this->order->contains($order)) {
            $this->order->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getOwner() === $this) {
                $order->setOwner(null);
            }
        }

        return $this;
    }


    public function getRoles()
    {
        // $roles = $this->userRoles->toArray();

        // dump($roles);

        $roles = $this->userRoles->map(function ($role) {
            return $role->getTitle();
        })->toArray();

        $roles[] = 'ROLE_USER';

        // dd($roles);

        // return['ROLE_USER'];

        return $roles;
    }

    public function getpassword()
    {
        return $this->hash;
    }

    public function getsalt()
    {
    }

    public function getUsername()
    {
        return $this->email;
    }
    public function eraseCredentials()
    {
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): self
    {
        $this->reset_token = $reset_token;

        return $this;
    }

    public function setRoles(?array $Roles): self
    {
        $this->Roles = $Roles;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        // set (or unset) the owning side of the relation if necessary
        $newUser = null === $cart ? null : $this;
        if ($cart->getUser() !== $newUser) {
            $cart->setUser($newUser);
        }

        return $this;
    }
}