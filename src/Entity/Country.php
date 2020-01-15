<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $flag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $capital;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="country")
     */
    private $commandes;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $inhabitants;

    /**
     * @ORM\Column(type="integer")
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     */
    private $coffeeQuantity;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Coffee", mappedBy="country")
     */
    private $coffees;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->coffees = new ArrayCollection();
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

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getCapital(): ?string
    {
        return $this->capital;
    }

    public function setCapital(string $capital): self
    {
        $this->capital = $capital;

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
            $commande->setCountry($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getCountry() === $this) {
                $commande->setCountry(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInhabitants(): ?int
    {
        return $this->inhabitants;
    }

    public function setInhabitants(int $inhabitants): self
    {
        $this->inhabitants = $inhabitants;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getCoffeeQuantity(): ?int
    {
        return $this->coffeeQuantity;
    }

    public function setCoffeeQuantity(int $coffeeQuantity): self
    {
        $this->coffeeQuantity = $coffeeQuantity;

        return $this;
    }

    /**
     * @return Collection|Coffee[]
     */
    public function getCoffees(): Collection
    {
        return $this->coffees;
    }

    public function addCoffee(Coffee $coffee): self
    {
        if (!$this->coffees->contains($coffee)) {
            $this->coffees[] = $coffee;
            $coffee->addCountry($this);
        }

        return $this;
    }

    public function removeCoffee(Coffee $coffee): self
    {
        if ($this->coffees->contains($coffee)) {
            $this->coffees->removeElement($coffee);
            $coffee->removeCountry($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}
