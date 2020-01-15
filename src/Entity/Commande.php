<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="commandes")
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="commandes")
     */
    private $exportateur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCommande;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="commandesImport")
     * @ORM\JoinColumn(nullable=false)
     */
    private $importateur_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coffee", inversedBy="commandes", fetch="EAGER")
     */
    private $coffeeType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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

    public function getExportateur(): ?Account
    {
        return $this->exportateur;
    }

    public function setExportateur(?Account $exportateur): self
    {
        $this->exportateur = $exportateur;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getImportateurId(): ?Account
    {
        return $this->importateur_id;
    }

    public function setImportateurId(?Account $importateur_id): self
    {
        $this->importateur_id = $importateur_id;

        return $this;
    }

    public function getCoffeeType(): ?Coffee
    {
        return $this->coffeeType;
    }

    public function setCoffeeType(?Coffee $coffeeType): self
    {
        $this->coffeeType = $coffeeType;

        return $this;
    }
}
