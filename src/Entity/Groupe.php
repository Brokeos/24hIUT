<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 */
class Groupe extends Role
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
    private $role;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $display;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="groups")
     */
    private $inherited;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Groupe", mappedBy="inherited")
     */
    private $groups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Account", mappedBy="role")
     */
    private $users;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getDisplay(): ?string
    {
        return $this->display;
    }

    public function setDisplay(string $display): self
    {
        $this->display = $display;

        return $this;
    }

    public function getInherited(): ?self
    {
        return $this->inherited;
    }

    public function setInherited(?self $inherited): self
    {
        $this->inherited = $inherited;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(self $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $group->setInherited($this);
        }

        return $this;
    }

    public function removeGroup(self $group): self
    {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
            // set the owning side to null (unless already changed)
            if ($group->getInherited() === $this) {
                $group->setInherited(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Account[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Account $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setRole($this);
        }

        return $this;
    }

    public function removeUser(Account $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getRole() === $this) {
                $user->setRole(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getDisplay();
    }

}
