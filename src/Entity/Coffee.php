<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoffeeRepository")
 */
class Coffee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coffeeType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Country", inversedBy="coffees")
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="stocks")
     */
    private $account;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="coffeeType")
     */
    private $commandes;

    public function __construct()
    {
        $this->country = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoffeeType(): ?string
    {
        return $this->coffeeType;
    }

    public function setCoffeeType(string $coffeeType): self
    {
        $this->coffeeType = $coffeeType;

        return $this;
    }

    /**
     * @return Collection|Country[]
     */
    public function getCountry(): Collection
    {
        return $this->country;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->country->contains($country)) {
            $this->country[] = $country;
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        if ($this->country->contains($country)) {
            $this->country->removeElement($country);
        }

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

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setCoffeeType($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getCoffeeType() === $this) {
                $commande->setCoffeeType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->coffeeType;
    }

}
