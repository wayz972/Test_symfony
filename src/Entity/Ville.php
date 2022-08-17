<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $longitude_radian = null;

    #[ORM\Column]
    private ?int $latitude_radian = null;

    #[ORM\OneToMany(mappedBy: 'ville', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLongitudeRadian(): ?int
    {
        return $this->longitude_radian;
    }

    public function setLongitudeRadian(int $longitude_radian): self
    {
        $this->longitude_radian = $longitude_radian;

        return $this;
    }

    public function getLatitudeRadian(): ?int
    {
        return $this->latitude_radian;
    }

    public function setLatitudeRadian(int $latitude_radian): self
    {
        $this->latitude_radian = $latitude_radian;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setVille($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getVille() === $this) {
                $user->setVille(null);
            }
        }

        return $this;
    }
    public function __toString():string
    {
        return $this->nom;
    }
}
