<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 * @UniqueEntity(fields={"username"}, message="Nom d'utilisateur déjà utilisé")
 */
class Account implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 20,
     *      minMessage = "Le mot de passe doit faire au minimum {{ limit }} charactères",
     *      maxMessage = "Le mot de passe ne peut pas dépasser {{ limit }} charactères"
     * )
     */
    private $plainPassword;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $office;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", cascade={"persist", "remove"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="exportateur")
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="importateur_id")
     */
    private $commandesImport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coffee", mappedBy="account")
     */
    private $stocks;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->commandesImport = new ArrayCollection();
        $this->stocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getRole(): ?Groupe
    {
        return $this->role;
    }

    public function setRole(?Groupe $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return array (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $roles = array();
        $groupe = $this->getRole();

        do {

            array_push($roles, $groupe);

        } while (($groupe = $groupe->getInherited()) != null);

        return $roles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getOffice(): ?string
    {
        return $this->office;
    }

    public function setOffice(string $office): self
    {
        $this->office = $office;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

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
            $commande->setExportateur($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getExportateur() === $this) {
                $commande->setExportateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandesImport(): Collection
    {
        return $this->commandesImport;
    }

    public function addCommandesImport(Commande $commandesImport): self
    {
        if (!$this->commandesImport->contains($commandesImport)) {
            $this->commandesImport[] = $commandesImport;
            $commandesImport->setImportateurId($this);
        }

        return $this;
    }

    public function removeCommandesImport(Commande $commandesImport): self
    {
        if ($this->commandesImport->contains($commandesImport)) {
            $this->commandesImport->removeElement($commandesImport);
            // set the owning side to null (unless already changed)
            if ($commandesImport->getImportateurId() === $this) {
                $commandesImport->setImportateurId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Coffee[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Coffee $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setAccount($this);
        }

        return $this;
    }

    public function removeStock(Coffee $stock): self
    {
        if ($this->stocks->contains($stock)) {
            $this->stocks->removeElement($stock);
            // set the owning side to null (unless already changed)
            if ($stock->getAccount() === $this) {
                $stock->setAccount(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->office;
    }

}
